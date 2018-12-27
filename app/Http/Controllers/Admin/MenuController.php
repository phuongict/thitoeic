<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Requests\AdminMenuRequest;
use App\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Illuminate\Support\MessageBag;

class MenuController extends Controller
{

    private $routeIndex = 'route_admin_menu_index';
    private $primary_table = 'menus';
    private $listParent = [];
    private $level = 1;

    public function __construct(Request $request)
    {
        $this->v['extParams'] = $request->all();
    }

    public function index(AdminMenuRequest $request)
    {
        $this->v['_title'] = 'Menu';
        $messageBag = new MessageBag;
        $rules = array(
            'page' => 'integer',
            'search_id' => 'nullable|integer',
            'search_name' => 'nullable|regex:/^[a-zA-Z0-9]{3,50}$/',
            'ord' => 'regex:/^[a-z0-9_]{1,50}$/',
            'ordval' => 'regex:/^[ascde]{3,4}$/'
        );
        $messagesValidate = [
            'search_id.integer' => 'Tham số ID phải nhập số',
            'search_category.integer' => 'Tham số Category phải là số',
            'search_name.regex' => 'Tên menu phải tối thiểu 3 ký tự',
            'page.integer' => 'Tham số page phải nhập số',
            'ord.regex' => 'Tham số ord chỉ nhận các chữ cái a-z',
            'ordval.regex' => 'Tham số ordval chỉ nhận giá trị asc hoặc desc'
        ];
        $validator = Validator::make($this->v['extParams'], $rules, $messagesValidate);
        // nếu lỗi thì chuyển về trang index không có tham số
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $item)
                $messageBag->add('errors', $item);
            $messages = $messageBag->getMessages();
            return redirect()->route($this->routeIndex)->withErrors($messages);
        }
        if (isset($this->v['extParams']['ordval']) && $this->v['extParams']['ordval'] == 'asc')
            $this->v['new_ordval'] = 'desc';
        else
            $this->v['new_ordval'] = 'asc';

        $objMenu = new Menu();
        $objCategory = new Categories();
        $this->v['list_categorys'] = $objCategory->getName();
        $this->v['list'] = $objMenu->loadListWithPager($this->v['extParams']);
        return view('admin.menus.index', $this->v);
    }

    /*
     * get parent for select
     */
    public function getParent($lists, $parent_id = 0, $char = '')
    {
        foreach ($lists as $key => $item) {
            if ($item->parents == $parent_id) {
                $this->listParent[] = '<option value="' . $item->id . '">' . $char . ' ' . $item->name . '</option>';
                unset($lists[$key]);
                $this->getParent($lists, $item->id, $char . ($char == '' ? '|---' : '---'));
            }
        }
        return $this->listParent;
    }

    public function getLevel($lists, $parent_id)
    {
        foreach ($lists as $key => $item) {
            if ($item->id == $parent_id) {
                unset($lists[$key]);
                $this->level += 1;
                $this->getLevel($lists, $item->parents);
                break;
            }
        }
        return $this->level;
    }

    public function add(AdminMenuRequest $request)
    {
        $this->v['_title'] = 'Add Menu';
        $method_route = 'route_admin_menu_add';
//        $objMenu = new Menu();
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        $objMenu = new Menu();
        $list = $objMenu->get();
//        echo '<pre>';
//        print_r($list);
//        echo '</pre>';die();
        $this->v['list_parents'] = $this->getParent($list);
//        dd($this->v['list_parents']);
        if ($request->isMethod('post')) {

//            echo '<pre>';
//            print_r($request->all());
//            echo '</pre>';die();
            if (Session::has($method_route)) {
                return redirect()->route($method_route); // không cho F5, chỉ có thể post 1 lần
            } else
                Session::push($method_route, 1); // bỏ vào session để chống F5
            $params = [
                'lang' => 'vi',
                'name' => trim($request->get('name')),
                'status' => 1,
                'parents' => $request->has('parents') ? intval($request->get('parents')) : 0,
                'level' => $request->has('parents') ? $this->getLevel($objMenu->get(), $request->get('parents')) : 1,
                'has_child' => intval($request->get('has_child')),
                'order' => intval($request->get('order')),
                'location' => trim($request->get('location')),
                'menu_type' => trim($request->get('menu_type')),
                'menu_value' => trim($request->get('menu_value')),
                'menu_acl' => trim($request->get('menu_acl')),
                'css_icon' => $request->has('css_icon') ? trim($request->get('css_icon')) : '<i class="material-icons">apps</i>',
                'c_id' => Auth::id(),
                'm_id' => Auth::id(),
                'c_time' => date('Y-m-d H:i:s'),
                'm_time' => date('Y-m-d H:i:s')
            ];
            $res = DB::table('menus')->insert($params);
            if (!$res) {
                $messageBag->add('errors', 'Thêm menu không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data', $this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            } else {
                $messageBag->add('success', 'Thêm menu thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        } else {
            // không phải post
            $request->session()->forget($method_route); // hủy session nếu vào bằng sự kiện get
        }
        $messages = $messageBag->getMessages();
        return view('admin.menus.add', $this->v)->withErrors($messages);
    }

    public function edit($id, AdminMenuRequest $request)
    {
        $this->v['_title'] = 'Edit Menu';
        $method_route = 'route_admin_menu_edit';
        $objMenu = new Menu();

        $this->v['objItem'] = $objMenu->loadOne($id);
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        if ($request->isMethod('post')) {
            if (Session::has($method_route)) {
                return redirect()->route($method_route, ['id' => $id]); // không cho F5, chỉ có thể post 1 lần
            } else
                Session::push($method_route, 1); // bỏ vào session để chống F5
//            echo '<pre>';
//            print_r($request->all());
//            echo '</pre>';die();
            $allRequest = [
                'lang' => 'vi',
                'name' => trim($request->get('name')),
                'status' => 1,
                'parents' => $request->has('parents') ? intval($request->get('parents')) : 0,
                'level' => $request->has('parents') ? $this->getLevel($objMenu->get(), $request->get('parents')) : 1,
                'has_child' => intval($request->get('has_child')),
                'order' => intval($request->get('order')),
                'location' => trim($request->get('location')),
                'menu_type' => trim($request->get('menu_type')),
                'menu_value' => trim($request->get('menu_value')),
                'menu_acl' => trim($request->get('menu_acl')),
                'css_icon' => $request->has('css_icon') ? trim($request->get('css_icon')) : '<i class="material-icons">apps</i>',
            ];
            $params = [
                'm_id' => Auth::id(),
                'm_time' => date('Y-m-d H:i:s')
            ];
            foreach ($allRequest as $key => $val) {
                if ($allRequest[$key] !== $this->v['objItem']->$key)
                    $params[$key] = $val;
            }
            $res = $objMenu->saveUpdate($id, $params);
            if (!$res) {
                $messageBag->add('errors', 'Cập nhật menu item không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data', $this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            } else {
                //ghi log
                $params = [
                    'user_id' => Auth::user()->id,
                    'action' => 'edit',
                    'table' => 'menus',
                    'detail' => 'IP: ' . $_SERVER['REMOTE_ADDR'],
                    'action_time' => date('Y-m-d H:i:s'),
                    'row_id' => $id
                ];
                $this->saveActivity($params);
                $messageBag->add('success', 'Cập nhật menu item thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        } else {
            // không phải post
            $request->session()->forget($method_route); // hủy session nếu vào bằng sự kiện get
        }
        $objMenu = new Menu();
        $list = $objMenu->get();
        $this->v['list_parents'] = $this->getParent($list);
        $messages = $messageBag->getMessages();
        return view('admin.menus.edit', $this->v)->withErrors($messages);
    }

    public function delete($id, AdminMenuRequest $request)
    {
        $this->v['_title'] = 'Delete Menu';
        $method_route = 'route_admin_menu_delete';
        $objMenu = new Menu();

        $this->v['objItem'] = $objMenu->loadOne($id);

        $messageBag = new MessageBag;
        //check category using
        $objMenu = new Menu();
        if ($request->isMethod('post')) {
            if ($request->get('id_menu') !== $id) {
                $messageBag->add('errors', 'ID không hợp lệ!');
                $messages = $messageBag->getMessages();
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
            try {
                /** @noinspection PhpUnhandledExceptionInspection */
                $res = $objMenu->where('id', $id)->delete();
                if (!$res) {
                    throw new Exception('Lỗi khi xóa menu item ID:' . $id);
                } else {
                    //ghi log
                    $params = [
                        'user_id' => Auth::user()->id,
                        'action' => 'delete',
                        'table' => 'menus',
                        'detail' => 'IP: ' . $_SERVER['REMOTE_ADDR'],
                        'action_time' => date('Y-m-d H:i:s'),
                        'row_id' => $id
                    ];
                    $this->saveActivity($params);
                    $messageBag->add('success', 'Xóa thành công menu item ID:' . $id);

                    $messages = $messageBag->getMessages();
                    return redirect()->route($this->routeIndex)->withErrors($messages);
                }

            } catch (Exception $e) {
                $messageBag->add('errors', $e->getMessage());
                $messages = $messageBag->getMessages();
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }

        $messages = $messageBag->getMessages();
        return view('admin.menus.delete', $this->v)->withErrors($messages);
    }


}
