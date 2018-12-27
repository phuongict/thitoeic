<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
class RoleController extends Controller
{
    public function list(){
        $data = Role::all();
        return view('admin.roles.list',['data'=>$data]);
    }
    public function getDelete($id){
        $data = Role::findOrFail($id);
        if($data == ''){
            return redirect('/admin/roles/list')->with('error','ID Group khong dung');
        }
        return view('admin.roles.delete',['data'=>$data]);
    }
    public function postDelete(Request $request,$id){
        if($request->txtGroup !== $id){
            return redirect('/admin/roles/list')->with('error','ID Group khong dung');
        }
        else{
            Role::findOrFail($request->txtGroup)->delete();
            return redirect('/admin/roles/list')->with('thongbao','Xoa thanh cong');
        }
    }
    public function getAdd(){
        return view('admin.roles.add');
    }
    public function postAdd(Request $request){
        $this->validate($request,
            [
                'txtTitle'=>'required|min:3|max:50'
            ],
            [
                'txtTitle.required'=>'Tên role không được để trống!',
                'txtTitle.min'=>'Tên role tối thiểu 3 ký tự!',
                'txtTitle.max'=>'Tên role tối đa 50 ký tự!'

            ]);
        $obj = new Role();
        $obj->title = $request->txtTitle;
        $obj->save();
        return redirect()->route('route_admin_role_list');
    }
    public function getEdit($id){
        $data = Role::findOrFail($id);
        return view('admin.roles.edit',['data'=>$data]);
    }
    public function postEdit(Request $request,$id){
        $this->validate($request,
            [
                'txtTitle'=>'required|min:3|max:50'
            ],
            [
                'txtTitle.required'=>'Tên role không được để trống!',
                'txtTitle.min'=>'Tên role tối thiểu 3 ký tự!',
                'txtTitle.max'=>'Tên role tối đa 50 ký tự!'

            ]);
        $data = Role::findOrFail($id);
        $data->title = $request->txtTitle;
        $data->save();
        return redirect()->route('route_admin_role_list')->with('thongbao','Cập nhật thành công!');
    }
}
