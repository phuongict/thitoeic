<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Http\Requests\AdminPostRequest;
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
class PostController extends Controller
{

    private $routeIndex = 'route_admin_post_index';
    private $primary_table = 'posts';


    public function __construct(Request $request)
    {
        $this->v['extParams'] = $request->all();
    }
    public function index(AdminPostRequest $request){
        $this->v['_title'] = 'Post';
        $messageBag = new MessageBag;



        $rules = array(
            'page' => 'integer',
            'search_id' => 'nullable|integer',
            'search_name' => 'nullable|regex:/^[a-zA-Z0-9]{3,50}$/',
            'search_category'=>'nullable|integer',
            'ord' => 'regex:/^[a-z0-9_]{1,50}$/',
            'ordval' => 'regex:/^[ascde]{3,4}$/'
        );
        $messagesValidate = [
            'search_id.integer' => 'Tham số ID phải nhập số',
            'search_category.integer' => 'Tham số Category phải là số',
            'search_name.regex' => 'Tên bài viết phải tối thiểu 3 ký tự',
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

        $objPost = new Posts();
        $objCategory = new Categories();
        $this->v['list_categorys'] = $objCategory->getName();
        $this->v['list'] = $objPost->loadListWithPager($this->v['extParams']);
        return view('admin.posts.index',$this->v);
    }
    public function add(AdminPostRequest $request){
        $this->v['_title'] = 'Add Post';
        $method_route = 'route_admin_post_add';
//        $objPost = new Posts();
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        if($request->isMethod('post')){
//            echo '<pre>';
//            print_r($request->all());
//            echo '</pre>';die();
            if(!$request->hasFile('image')){
                $messageBag->add('errors','Lỗi không tồn tại file ảnh');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            $image = $request->file('image');
            $endfile = $image->getClientOriginalExtension();
            if(!in_array($endfile,config('app.img_extension'))){
                $messageBag->add('errors','Vui lòng chỉ chọn định dạng ảnh');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            $fileName = date('Y_m_d_H_i_s_').$image->getClientOriginalName();
            $filePath = $image->storeAs(config('app.post_storage_path'),$fileName,'public');
//            $namefile = RemoveCircuflex(date('Y_m_d').'_'.$image->getClientOriginalName());
            $params = [
                'title'=>trim($request->title),
                'content'=>trim($request->content2),
                'tags'=>trim($request->get('tags')),
                'category_id'=>intval($request->get('category_id')),
                'image'=>$filePath,
                'c_id'=>Auth::id(),
                'm_id'=>Auth::id(),
                'c_time'=>date('Y-m-d H:i:s'),
                'm_time'=>date('Y-m-d H:i:s')
            ];
//            $image->move(public_path().'/front/images/posts',$namefile);
            $res = DB::table('posts')->insert($params);
            if(!$res){
                $messageBag->add('errors','Thêm bài viết không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            else{
                $messageBag->add('success','Thêm bài viết thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }
        $messages = $messageBag->getMessages();
        $objCategory = new Categories();
        $this->v['list_categorys'] = $objCategory->getName();
        return view('admin.posts.add',$this->v)->withErrors($messages);
    }
    public function edit($id,AdminPostRequest $request){
        $this->v['_title'] = 'Edit Post';
        $method_route = 'route_admin_post_edit';
        $objPost = new Posts();

        $this->v['objItem'] = $objPost->loadOne($id);
        $messageBag = new MessageBag;
        $this->v['request'] = Session::pull('post_form_data')[0];
        if($request->isMethod('post')){
//            $namefile = '';
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
//                $namefile = RemoveCircuflex(date('Y_m_d').'_'.$image->getClientOriginalName());
//                $image->move(public_path().'/front/images/posts',$namefile);
                $fileName = date('Y_m_d_H_i_s_').$image->getClientOriginalName();
                $filePath = $image->storeAs(config('app.post_storage_path'),$fileName,'public');
                //xoa anh cu
                if($this->v['objItem']->image !== ''){
                    if(Storage::disk('public')->exists(config('app.post_storage_path').'/'.$this->v['objItem']))
                        Storage::disk('public')->delete(config('app.post_storage_path').'/'.$this->v['objItem']);
                }
            }
            $allRequest = $request->all();
            unset($allRequest['_token']);
            unset($allRequest['image']);
            unset($allRequest['content2']);
            $params = [
                'content'=>trim($request->get('content2')),
                'image'=>isset($filePath)?$filePath:$this->v['objItem']->image,
                'm_id'=>Auth::id(),
                'm_time'=>date('Y-m-d H:i:s')
            ];
            foreach($allRequest as $key=>$val){
                if($allRequest[$key]!== $this->v['objItem']->$key)
                    $params[$key] = $val;
            }
            $res = $objPost->saveUpdate($id,$params);
            if(!$res){
                $messageBag->add('errors','Cập nhật bài viết không thành công!');
                $messages = $messageBag->getMessages();
                Session::push('post_form_data',$this->v['request']);
                return redirect()->route($method_route)->withErrors($messages);
            }
            else{
                //ghi log
                $params = [
                    'user_id'=>Auth::user()->id,
                    'action'=>'edit',
                    'table'=>'posts',
                    'detail'=>'IP: '. $_SERVER['REMOTE_ADDR'],
                    'action_time'=>date('Y-m-d H:i:s'),
                    'row_id' => $id
                ];
                $this->saveActivity($params);
                $messageBag->add('success','Cập nhật bài viết thành công!');
                $messages = $messageBag->getMessages();
                $request->session()->forget('post_form_data');
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
        }
        $objCategory = new Categories();
        $this->v['list_categorys'] = $objCategory->getName();
        $messages = $messageBag->getMessages();
        return view('admin.posts.edit',$this->v)->withErrors($messages);
    }
    public function delete($id,AdminPostRequest $request){
        $this->v['_title'] = 'Delete Post';
        $method_route = 'route_admin_post_delete';
        $objPost = new Posts();

        $this->v['objItem'] = $objPost->loadOne($id);

        $messageBag = new MessageBag;
        //check category using
        $objPost = new Posts();
        if($request->isMethod('post')){
            if($request->get('id_post')!== $id){
                $messageBag->add('errors','ID không hợp lệ!');
                $messages = $messageBag->getMessages();
                return redirect()->route($this->routeIndex)->withErrors($messages);
            }
            try{
                /** @noinspection PhpUnhandledExceptionInspection */
                $res = $objPost->where('id',$id)->delete();
                if(!$res){
                    throw new Exception('Lỗi khi xóa bài viết ID:'.$id);
                }
                else{
                    //ghi log
                    $params = [
                        'user_id'=>Auth::user()->id,
                        'action'=>'delete',
                        'table'=>'posts',
                        'detail'=>'IP: '. $_SERVER['REMOTE_ADDR'],
                        'action_time'=>date('Y-m-d H:i:s'),
                        'row_id' => $id
                    ];
                    $this->saveActivity($params);
                    $messageBag->add('success','Xóa thành công bài viết ID:'.$id);
                    if(file_exists(public_path().'/front/images/posts/'.$this->v['objItem']->image)){
                        File::delete(public_path().'/front/images/posts/'.$this->v['objItem']->image);
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
        return view('admin.posts.delete',$this->v)->withErrors($messages);
    }

}
