<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table='roles';
    protected $fillable = ['id', 'title', 'created_at', 'updated_at'];
    public $timestamps = false;
    public function permission(){
        return $this->belongsToMany(Permission::class,'role_permissions');
    }
}
