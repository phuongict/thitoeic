<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
class PermissionController extends Controller
{
    public function getAdd(){
        return view('admin.permissions.add');
    }
    public function postAdd(Request $request){
        $obj = new Permission();
        $obj->title = $request->txtTitle;
        $obj->username = $request->txtName;
        $obj->save();
        return redirect()->route('route_admin_permission_list');
    }
    public function list(){
        $data = Permission::all();
        return view('admin.permissions.list',['data'=>$data]);
    }
    public function getDelete($id){
        $data = Permission::findOrFail($id);
        if($data == ''){
            return redirect('/admin/permissions/list')->with('error','ID Permission khong dung');
        }
        return view('admin.permissions.delete',['data'=>$data]);
    }
    public function postDelete(Request $request,$id){
        if($request->txtPermission !== $id){
            return redirect('/admin/permissions/list')->with('error','ID Group khong dung');
        }
        else{
            Permission::findOrFail($request->txtPermission)->delete();
            return redirect('/admin/permissions/list')->with('thongbao','Xoa thanh cong');
        }
    }
    public function getEdit($id){
        $data = Permission::findOrFail($id);
        return view('admin.permissions.edit',['data'=>$data]);
    }
    public function postEdit(Request $request,$id){
        $obj = new Permission();
        $obj->where('id','=',$id)
            ->update(['title'=>$request->txtTitle,'name'=>$request->txtName]);
        return redirect()
            ->route('route_admin_permission_list')
            ->with('thongbao','Cập nhật thành công!');
    }
}
