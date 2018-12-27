<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use App\RolePermisson;
use Illuminate\Support\Collection;
class RolePermissionController extends Controller
{
    public function getEdit($id){
        $data = Permission::all();
        $obj = new Role();
        $role = $obj->find($id);
        $list =  $role->permission;
        return view('admin.rolepermission.edit',['data'=>$data,'listPermisson'=>$list,'id'=>$id]);
    }
    public function postEdit(Request $request,$id){
        $res = $request->all();
        unset($res['_token']);
        unset($res['dataTables-example_length']);

        $yes = array();
        $no = array();
        foreach($res as $value){
            if(substr($value,0,3) == 'ye_'){
                $yes[] = substr($value,'3',strlen($value));
            }
            if(substr($value,0,3) == 'no_'){
                $no[] = substr($value,'3',strlen($value));
            }
        }
        //lay danh sach quyen cua role
       $obj = new Role();
        $role = $obj->find($id);
        $listPermission =  $role->permission->toArray();
        $idPermission = array();
        foreach($listPermission as $value){
            $idPermission[] = $value['pivot']['permission_id'];
        }
        //kiem tra co quyen chua và them vào
        foreach($yes as $val){
            if(in_array($val,$idPermission)){
                //co roi
                continue;
            }
            else {
                //them quyen
                $permission = Permission::findOrFail($val);
                $role->permission()->save($permission);
            }
        }

        //kiem tra quyen co chua co roi thi xoa
        foreach($no as $val){
            if(in_array($val,$idPermission)){
                //co roi
                $obj2 = new RolePermisson();
                $obj2->where([['role_id','=',$id],['permission_id','=',$val]])->delete();
            }
            else {
                //them quyen
                continue;
            }
        }
        return redirect('admin/rolepermission/edit/'.$id)->with('thongbao','Cập nhật thành công!');
    }
}
