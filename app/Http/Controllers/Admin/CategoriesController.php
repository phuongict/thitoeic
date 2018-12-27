<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Requests\AdminCategoryRequest;
use App\Posts;
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
class CategoriesController extends Controller
{

    private $routeIndex = 'route_admin_categories_index';
    private $primary_table = 'categories';


    public function __construct(Request $request)
    {
        $this->v['extParams'] = $request->all();
    }
    public function index(AdminCategoryRequest $request){
        $this->v['_title'] = 'Catergory';
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
            'search_name.regex' => 'Tên danh mục phải tối thiểu 3 ký tự',
            'page.integer' => 'Tham số page phải nhập số',
            'ord.regex' => 'Tham số ord chỉ nhận các chữ cái a-z',
            'ordval.regex' => 'Tham số ordval chỉ nhận giá trị asc hoặc desc'
        ];
        $validator = Validator::make($this->v['extParams'], $rules, $messagesValidate);
        // nếu lỗi thì chuyển về trang index không có tham số
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $item)
            $messageBag->add('errors',$item);
            $messages = $messageBag->getMessages();
            return redirect()->route($this->routeIndex)->withErrors($messages);
        }
        if (isset($this->v['extParams']['ordval']) && $this->v['extParams']['ordval'] == 'asc')
            $this->v['new_ordval'] = 'desc';
        else
            $this->v['new_ordval'] = 'asc';

        $objCategory = new Categories();

        $this->v['list'] = $objCategory->loadListWithPager($this->v['extParams']);
        return view('admin.categories.index',$this->v);
    }
    public function add(AdminCategoryRequest $request){
        $this->v['_title'] = 'Add Category';
        $method_route = 'route_admin_categories_add';
        $objCategory = new Categories();
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        if($request->isMethod('post')){
            if(!$request->hasFile('image')){
                $messageBag->add('errors','Lỗi không tồn tại file ảnh');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            $image = $request->file('image');
            $endfile = $image->getClientOriginalExtension();
            $formatImg = ['jpg','png','gif','jpeg'];
            if(!in_array($endfile,$formatImg)){
                $messageBag->add('errors','Vui lòng chỉ chọn định dạng ảnh');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }

            $namefile = RemoveCircuflex(date('Y_m_d').'_'.$image->getClientOriginalName());
            $params = [
                'name'=>trim($request->name),
                'description'=>trim($request->description),
                'image'=>$namefile,
                'c_id'=>Auth::id(),
                'm_id'=>Auth::id(),
                'c_time'=>date('Y-m-d H:i:s'),
                'm_time'=>date('Y-m-d H:i:s')
            ];
            $image->move(public_path().'/front/images/categories',$namefile);
            $res = DB::table('categories')->insert($params);
            if(!$res){
                $messageBag->add('errors','Thêm danh mục không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            else{
                $messageBag->add('success','Thêm danh mục thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }
        $messages = $messageBag->getMessages();
        return view('admin.categories.add',$this->v)->withErrors($messages);
    }
    public function edit($id,AdminCategoryRequest $request){
        $this->v['_title'] = 'Edit Category';
        $method_route = 'route_admin_categories_edit';
        $objCategory = new Categories();

        $this->v['objItem'] = $objCategory->loadOne($id);
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        if($request->isMethod('post')){
            $namefile = '';
            if($request->hasFile('image')){
                $image = $request->file('image');
                $endfile = $image->getClientOriginalExtension();
                $formatImg = ['jpg','png','gif','jpeg'];
                if(!in_array($endfile,$formatImg)){
                    $messageBag->add('errors','Vui lòng chỉ chọn định dạng ảnh');
                    $messages = $messageBag->getMessages();
                    Session::push('post_form_data',$this->v['request']);
                    return redirect()->route($method_route)->withErrors($messages);
                }
                $namefile = RemoveCircuflex(date('Y_m_d').'_'.$image->getClientOriginalName());
                $image->move(public_path().'/front/images/categories',$namefile);
            }
            $allRequest = $request->all();
            unset($allRequest['_token']);
            unset($allRequest['image']);
            $params = [
                'image'=>$namefile==''?$this->v['objItem']->image:$namefile,
                'm_id'=>Auth::id(),
                'm_time'=>date('Y-m-d H:i:s')
            ];
            foreach($allRequest as $key=>$val){
                if($allRequest[$key]!== $this->v['objItem']->$key)
                    $params[$key] = $val;
            }
            $res = $objCategory->saveUpdate($id,$params);
            if(!$res){
                $messageBag->add('errors','Cập nhật danh mục không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            else{
                //ghi log
                $params = [
                    'user_id'=>Auth::user()->id,
                    'action'=>'edit',
                    'table'=>'categories',
                    'detail'=>'IP: '. $_SERVER['REMOTE_ADDR'],
                    'action_time'=>date('Y-m-d H:i:s'),
                    'row_id' => $id
                ];
                $this->saveActivity($params);
                $messageBag->add('success','Cập nhật danh mục thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }
        $messages = $messageBag->getMessages();
        return view('admin.categories.edit',$this->v)->withErrors($messages);
    }
    public function delete($id,AdminCategoryRequest $request){
        $this->v['_title'] = 'Delete Category';
        $method_route = 'route_admin_categories_delete';
        $objCategory = new Categories();

        $this->v['objItem'] = $objCategory->loadOne($id);

        $messageBag = new MessageBag;
        //check category using
        $objPost = new Posts();
        $getRow = $objPost->where('category_id',$id)->count();
        if($getRow>0||$this->v['objItem'] == null){
            $messageBag->add('errors','Danh mục này đã có bài viết hoặc không tồn tại!');
            $messages = $messageBag->getMessages();
            return redirect()->route($this->routeIndex)->withErrors($messages);
        }
        if($request->isMethod('post')){
            if($request->get('id_category')!== $id){
                $messageBag->add('errors','ID không hợp lệ!');
                $messages = $messageBag->getMessages();
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
            try{
                /** @noinspection PhpUnhandledExceptionInspection */
                $res = $objCategory->where('id',$id)->delete();
                if(!$res){
                    throw new Exception('Lỗi khi xóa category ID:'.$id);
                }
                else{
                    //ghi log
                    $params = [
                        'user_id'=>Auth::user()->id,
                        'action'=>'delete',
                        'table'=>'categories',
                        'detail'=>'IP: '. $_SERVER['REMOTE_ADDR'],
                        'action_time'=>date('Y-m-d H:i:s'),
                        'row_id' => $id
                    ];
                    $this->saveActivity($params);
                    $messageBag->add('success','Xóa thành công category ID:'.$id);
                    if(file_exists(public_path().'/front/images/categories/'.$this->v['objItem']->image)){
                        File::delete(public_path().'/front/images/categories/'.$this->v['objItem']->image);
                    }
                    $messages = $messageBag->getMessages();
                    return redirect()->route($this->routeIndex)->withErrors($messages);
                }

            }
            catch (Exception $e){
                $messageBag->add('errors',$e->getMessage());
                $messages = $messageBag->getMessages();
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }

        $messages = $messageBag->getMessages();
        return view('admin.categories.delete',$this->v)->withErrors($messages);
    }

}
