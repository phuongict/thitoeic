<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::middleware(['auth'])->group(function () {
    Route::group(['prefix' => 'admin'], function () {
//        Route::get('/index', 'Admin\IndexController@index')
//            ->name('route_admin_index');
            Route::get('/',function(){
               return view('admin.index');
            });

        Route::group(['prefix'=>'rolepermission'],function(){
            Route::get('edit/{id}','Admin\RolePermissionController@getEdit')
                ->name('route_admin_edit_get_permission')
                ->middleware('can:admin_role_permission_edit');
            Route::post('edit/{id}', 'Admin\RolePermissionController@postEdit')
                ->name('route_admin_edit_post_permission')
                ->middleware('can:admin_role_permission_edit');
        });


        Route::group(['prefix'=>'permissions'],function(){
            Route::get('list','Admin\PermissionController@list')
                ->name('route_admin_permission_list')
                ->middleware('can:admin_permission_list');
            Route::get('add','Admin\PermissionController@getAdd')
                ->name('route_admin_permission_get_add')
                ->middleware('can:admin_permission_add');
            Route::post('add','Admin\PermissionController@postAdd')
                ->name('route_admin_permission_post_add')
                ->middleware('can:admin_permission_add');
            Route::get('delete/{id}','Admin\PermissionController@getDelete')
                ->name('route_admin_permission_get_delete')
                ->middleware('can:admin_permission_delete');
            Route::post('delete/{id}','Admin\PermissionController@postDelete')
                ->name('route_admin_permission_post_delete')
                ->middleware('can:admin_permission_delete');
            Route::get('edit/{id}','Admin\PermissionController@getEdit')
                ->name('route_admin_permission_get_edit')
                ->middleware('can:admin_permission_edit');
            Route::post('edit/{id}','Admin\PermissionController@postEdit')
                ->name('route_admin_permission_post_edit')
                ->middleware('can:admin_permission_edit');

        });


        Route::group(['prefix'=>'roles'],function(){
            Route::get('list','Admin\RoleController@list')
                ->name('route_admin_role_list')
                ->middleware('can:admin_role_list');
            Route::get('delete/{id}','Admin\RoleController@getDelete')
                ->name('route_admin_role_get_delete')
                ->middleware('can:admin_role_delete');
            Route::post('delete/{id}','Admin\RoleController@postDelete')
                ->name('route_admin_role_post_delete')
                ->middleware('can:admin_role_delete');
            Route::get('add','Admin\RoleController@getAdd')
                ->name('route_admin_role_get_add')
                ->middleware('can:admin_role_add');
            Route::post('add','Admin\RoleController@postAdd')
                ->name('route_admin_role_post_add')
                ->middleware('can:admin_role_add');
            Route::get('edit/{id}','Admin\RoleController@getEdit')
                ->name('route_admin_role_get_edit')
                ->middleware('can:admin_role_edit');
            Route::post('edit/{id}','Admin\RoleController@postEdit')
                ->name('route_admin_role_post_edit')
                ->middleware('can:admin_role_edit');
        });

        Route::group(['prefix'=>'users'],function(){
             Route::get('list','Admin\UserController@list')
                 ->name('route_admin_user_list')
                 ->middleware('can:admin_user_list');

            Route::get('delete/{id}','Admin\UserController@getDelete')
                ->name('route_admin_user_get_delete')
                ->middleware('can:admin_user_delete');

            Route::post('delete/{id}','Admin\UserController@postDelete')
                ->name('route_admin_user_post_delete')
                ->middleware('can:admin_user_delete');

            Route::get('add','Admin\UserController@getAdd')
                ->name('route_admin_user_get_add')
                ->middleware('can:admin_user_add');

            Route::post('add','Admin\UserController@postAdd')
                ->name('route_admin_user_post_add')
                ->middleware('can:admin_user_add');

            Route::get('edit/{id}','Admin\UserController@getEdit')
                ->name('route_admin_user_get_edit')
                ->middleware('can:admin_user_edit');

            Route::post('edit/{id}','Admin\UserController@postEdit')
                ->name('route_admin_user_post_edit')
                ->middleware('can:admin_user_edit');
        });



//category
        Route::group(['prefix'=>'category'],function(){
            Route::get('/','Admin\CategoriesController@index')->name('route_admin_categories_index');//->middleware('can:admin_categories_index');
            Route::match(['get','post'],'/add','Admin\CategoriesController@add')->name('route_admin_categories_add');//->middleware('can:admin_categories_add');
            Route::match(['get','post'],'/edit/{id}','Admin\CategoriesController@edit')->where('id','[0-9]+')->name('route_admin_categories_edit');//->middleware('can:admin_categories_add');
            Route::match(['get','post'],'/delete/{id}','Admin\CategoriesController@delete')->where('id','[0-9]+')->name('route_admin_categories_delete');//->middleware('can:admin_categories_add');

        });
        //post
        Route::group(['prefix'=>'post'],function(){
            Route::get('/','Admin\PostController@index')->name('route_admin_post_index');//->middleware('can:admin_post_index');
            Route::match(['get','post'],'/add','Admin\PostController@add')->name('route_admin_post_add');//->middleware('can:admin_post_add');
            Route::match(['get','post'],'/edit/{id}','Admin\PostController@edit')->where('id','[0-9]+')->name('route_admin_post_edit');//->middleware('can:admin_post_add');
            Route::match(['get','post'],'/delete/{id}','Admin\PostController@delete')->where('id','[0-9]+')->name('route_admin_post_delete');//->middleware('can:admin_post_add');
        });
        //menu
        Route::group(['prefix'=>'menu'],function(){
            Route::get('/','Admin\MenuController@index')->name('route_admin_menu_index');//->middleware('can:admin_menu_index');
            Route::match(['get','post'],'/add','Admin\MenuController@add')->name('route_admin_menu_add');//->middleware('can:admin_menu_add');
            Route::match(['get','post'],'/edit/{id}','Admin\MenuController@edit')->where('id','[0-9]+')->name('route_admin_menu_edit');//->middleware('can:admin_menu_add');
            Route::match(['get','post'],'/delete/{id}','Admin\MenuController@delete')->where('id','[0-9]+')->name('route_admin_menu_delete');//->middleware('can:admin_menu_add');
        });

    });
});
//Auth::routes();
/****************************
 * master
 ****************************/
    Route::get('/',function(){
       return view('master.index.index');
    });








/****************************
 * Auth
 ****************************/
    Route::get('/login','Auth\LoginController@getLogin')->name('login');
    Route::post('/login','Auth\LoginController@postLogin');
    //Route::get('/logout',function(){
    //   echo 'test';
    //});
    //Route::get('/logout','Auth\LoginController@logout')->name('logout');
    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'Auth\LoginController@logout'
    ]);
    // Password Reset Routes...
    Route::post('password/email', [
        'as' => 'password.email',
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail'
    ]);
    Route::get('password/reset', [
        'as' => 'password.request',
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm'
    ]);
    Route::post('password/reset', [
        'as' => '',
        'uses' => 'Auth\ResetPasswordController@reset'
    ]);
    Route::get('password/reset/{token}', [
        'as' => 'password.reset',
        'uses' => 'Auth\ResetPasswordController@showResetForm'
    ]);

    // Registration Routes...
    Route::get('register', [
        'as' => 'register',
        'uses' => 'Auth\RegisterController@showRegistrationForm'
    ]);
    Route::post('register', [
        'as' => '',
        'uses' => 'Auth\RegisterController@register'
    ]);
    //Route::get('/reset-password','Auth\ResetPasswordController@getReset')->name('password.request');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/clear',function(){
        $path_view = storage_path().'/framework/views';
        $fview = scandir($path_view);
        foreach($fview as $fv){
            if($fv =='.' || $fv =='..' || $fv == '.gitignore') continue;
            $frm = $path_view.'/'.$fv;
            echo "<br>Xoa file cache: $frm";
            unlink($frm);
        }
    });