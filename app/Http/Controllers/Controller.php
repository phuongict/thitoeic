<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\MessageBag;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $v=[
        'routeIndex' => 'route_BackEnd_Role_index',
        'methodText' => 'Categories',
        'extParams' => []
    ];

    protected function saveActivity($params){
        $res = DB::table('user_activitys')->insert($params);
        return $res;
    }
}
