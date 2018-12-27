<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Mockery\Exception;
use Auth;
class UserController extends Controller
{
    public function list(){
       /* $obj = new User();
        $data = $obj->select(['users.id','name','email','title'])
                    ->join('roles','users.role_id','=','roles.id')
                    ->get();*/
       $data = User::all();
        return view('admin.users.list',['data'=>$data]);
    }
    public function getEdit($id){
        $listRole = Role::all();
        $data = User::findOrFail($id);
        return view('admin.users.edit',['data'=>$data,'listRole'=>$listRole]);
    }
    public function postEdit(Request $request,$id){
        $data = User::findOrFail($id);
        $data->username = $request->txtName;
        $data->email = $request->txtEmail;
        $data->role_id = $request->txtRole;
        $data->save();
        return redirect()->route('route_admin_user_list')->with('thongbao','Sửa thành công!');
    }
    public function getDelete($id){
        $data = User::findOrFail($id);
        return view('admin.users.delete',['data'=>$data]);
    }
    public function postDelete(Request $request,$id){
            if ($request->txtUser !== $id) {
                return redirect()->route('route_admin_user_list')->with('error', 'Lỗi xóa dữ liệu');
            }

            User::findOrFail($request->txtUser)->delete();
        return redirect()->route('route_admin_user_list')->with('thongbao','Xóa thành công!');
    }
    public function getAdd(){
        $listRole = Role::all();
        return view('admin.users.add',['listRole'=>$listRole]);
    }
    public function postAdd(Request $request){
        $this->validate($request,
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ],
            [
                'name.required'=>'Tên người dùng không được để trống!',
                'name.string'=>'Tên người dùng phải là chuỗi ký tự!',
                'name.max'=>'Tên người dùng tối đa 255 ký tự!',
                'email.required'=>'Email không được để trống!',
                'email.string'=>'Email phải là chuỗi ký tự!',
                'email.email'=>'Định dạng email không hợp lệ!',
                'email.max'=>'Email tối đa 255 ký tự!',
                'email.unique'=>'Email đã có người sử dụng!',
                'password.required'=>'Password không được để trống!',
                'password.string'=>'Password phải là chuỗi ký tự!',
                'password.min'=>'Password tối thiểu 6 ký tự!',
                'password.confirmed'=>'Password phải trùng nhau!',
            ]);
        $user = new User();
        $user->username = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->txtRole;
        $user->save();
        return redirect()->route('route_admin_user_list')->with('thongbao','Thêm user thành công!');
    }
}
