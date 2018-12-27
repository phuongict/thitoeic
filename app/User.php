<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','birth_day','first_name','last_name','gender','phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /*
     * Phan quyen
     */
    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function hasPermission(Permission $permission){

        return !! optional(optional($this->role)->permission)->contains($permission);

    }
}
