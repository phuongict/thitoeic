<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Permission;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->id == 1) {
                return true;
            }
        });
        if(!$this->app->runningInConsole()){
            //không phải chạy trong console thì mới làm việc này
            foreach (Permission::all() as $permission){
                Gate::define($permission->username, function($user) use($permission){
                    return $user->hasPermission($permission);
                    // hàm hasPermission cần phải tự viết ở trong file model User.php
                });
            }
        }
    }
}
