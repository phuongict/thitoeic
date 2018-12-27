<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
class Categories extends Model
{
    protected $table = 'categories';
    protected $fillable = ['tb1.id','tb1.name','tb1.description','tb1.image','tb1.c_id','tb1.m_id','tb1.d_id','tb1.c_time','tb1.m_time','tb1.d_time'];
    public $timestamps = false;



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
    public function getName(){
        return DB::table($this->table)->select('id','name')->get();
    }
}
