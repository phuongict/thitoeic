<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table='permissions';
    protected $fillable = ['id','name', 'title','group','controller', 'created_at', 'updated_at'];
    public $timestamps = false;
    public function roles(){
        return $this->belongsToMany(Role::class,'role_permissions');
    }
}
