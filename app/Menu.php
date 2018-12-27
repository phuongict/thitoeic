<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = ['tb1.id','tb1.lang','tb1.name','tb1.status','tb1.parents','tb1.level','tb1.has_child','tb1.order','tb1.location','tb1.menu_type','tb1.menu_value','tb1.menu_acl','tb1.css_icon','tb1.view_pms','tb1.ext_permission','tb1.c_id','tb1.m_id','tb1.c_time','tb1.m_time','tb1.c_g','tb1.d_id','tb1.d_time'];
    public $timestamps = false;
    private $menu=[];


    public function createStdClass(){
        $objItem = new \stdClass();
        foreach ($this->fillable as $field){
            $field = substr($field,4);
            $objItem->$field = null;
        }
        return $objItem;
    }


    public function loadListWithPager($params = array())
    {
        $query = DB::table($this->table.' as tb1')
            ->select( array_merge($this->fillable,['tb2.username as uName']));


        if (isset($params['recycle']) && $params['recycle'] == 1)
            $query->where('tb1.d_id', '<>', 0);
        else
            $query->where('tb1.d_id', '=', 0);


        if (isset($params['search_id']) && $params['search_id'] > 0)
            $query->where('tb1.id', '=', intval($params['search_id']));

        if (isset($params['search_name']) && strlen($params['search_name']) > 0)
            $query->where('tb1.name', 'like', '%' . $params['search_name'] . '%');

        if (isset($params['ord']) && in_array( 'tb1.'. $params['ord'], $this->fillable)) {
            if (isset($params['ordval']) && $params['ordval'] == 'desc')
                $query->orderBy('tb1.' . $params['ord'], 'desc');
            else
                $query->orderBy('tb1.' . $params['ord'], 'asc');
        }

        $query->leftJoin('users as tb2', 'tb2.id', '=', 'tb1.c_id');

        $list = $query->paginate(config('app.backend_row_per_page'));
        return $list;
    }

    public function loadOne($id, $params = null)
    {

        $query = DB::table($this->table.' as tb1')
            ->select( array_merge($this->fillable,['tb2.username as uName']))
            ->where('tb1.id', '=', $id);

        if (isset($params['event']) && $params['event'] == 'restore') {
            $query->where('tb1.d_id', '<>', 0);
            $query->leftJoin('users as tb2', 'tb2.id', '=', 'tb1.d_id');
        } else {
            $query->where('tb1.d_id', '=', 0);
            $query->leftJoin('users as tb2', 'tb2.id', '=', 'tb1.m_id');
        }

        $obj = $query->first();
        return $obj;
    }

    public function saveUpdate($id,$params)
    {
        $res = DB::table($this->table)
            ->where('id', $id)
            ->where('d_id', '=', 0)
            ->limit(1)
            ->update($params);
        if (empty($res) || !is_numeric($res)) {
            Log::error(__METHOD__ . ':: ' . $res . '-->' . json_encode($params));
        }
        return $res;
    }

    public function saveDelete($params)
    {

//        $params = ['cols'=>['col'=>'new_value'],'user_edit'=>'id'];

        if (empty($params['user_edit'])) {
            Log::warning(__METHOD__ . ' Không xác định thông tin người cập nhật');
            Session::push('errors', 'Không xác định thông tin người cập nhật');
            return null;
        }

        if (empty($params['cols']['id'])) {
            Session::push('errors', 'Không xác định bản ghi cần cập nhật');
            return null;
        }


        if ($params['event'] == 'restore') {
            $dataUpdate = ['d_id' => 0,
                'd_time' => null
            ];
        } elseif ($params['event'] == 'delete') {
            $dataUpdate = ['d_id' => $params['user_edit'],
                'd_time' => date('Y-m-d H:i:s')
            ];
        } else {
            Session::push('errors', 'Không xác định thao tác!');
            return null;
        }


        $res = DB::table($this->table)
            ->where('id', $params['cols']['id'])
            ->limit(1)
            ->update($dataUpdate);

        if (empty($res) || !is_numeric($res)) {
            Log::error(__METHOD__ . ':: ' . $res . '-->' . json_encode($dataUpdate));
        }

        return $res;
    }
    /*
     * Load menu to layout
     */
    public function loadMainMenu($location){
        $list = $this->where([['location',$location],['status',1]])->orderBy('order','asc')->get();
        $a = $this->setUpMenu($list);
        return $a;
    }
    public function setUpMenu($menus, $parent_id = 0){
        // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
        $cate_child = array();
        foreach ($menus as $key => $item)
        {
            // Nếu có con thì nhét vào mảng
            if ($item->parents == $parent_id)
            {
                $cate_child[] = $item;
                unset($menus[$key]);
            }
        }

        if ($cate_child)
        {

            if($item->parents == 0 && $item->has_child == 0){
                $this->menu[] = '<li>';
                $link = $item->menu_type == 'Link'?$item->menu_value:Route($item->menu_value);
                $this->menu[] = '<a href="'.$link.'">';
                $this->menu[] = $item->css_icon;
                $this->menu[] = '<p>'.$item->name.'</p>';
                $this->menu[] = '</a>';
                $this->menu[] = '</li>';
            }
            else{

                foreach ($cate_child as $key => $item)
                {
                    if($item->has_child==1){
                        $this->menu[] = '<li>';
                        $this->menu[] = '<a data-toggle="collapse" href="#'.$item->menu_acl.'">';
                        $this->menu[] = $item->css_icon;
                        $this->menu[] = '<p>'.$item->name.'<b class="caret"></b></p>';
                        $this->menu[] = '</a>';
                        $this->menu[] = '<div class="collapse" id="'.$item->menu_acl.'">';
                        $this->menu[] = '<ul class="nav">';
                        $this->setUpMenu($menus, $item['id']);
                        $this->menu[] = '<ul></ul></div></li>';
                    }
                    else{
                        $link = $item->menu_type == 'Link'?$item->menu_value:Route($item->menu_value);
                        $this->menu[] = '<li>';
                        $this->menu[] = '<a href="'.$link.'">'.$item->name.'</a>';
                        $this->menu[] = '</li>';
                    }
                }
            }

        }
        return $this->menu;
    }
}
