<?php

namespace App\Providers;

use App\Menu;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //dùng để đưa mảng menu html vào layout
        view()->composer('admin/layouts/admin', function ($view) {
            $objMenu = new Menu();
            $menu = $objMenu->loadMainMenu('backend');
            $view->with('main_menu', $menu);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
