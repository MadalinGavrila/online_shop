<?php

Auth::routes();

Route::get('auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');

Route::get('auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');

Route::post('auth/activate/resend', 'Auth\ActivationResendController@resend');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@index')->name('home.contact');

Route::post('/contact', 'ContactController@sendMail');

Route::get('/product', 'HomeController@product')->name('home.product');

Route::group(['middleware' => 'role:admin'], function(){

    Route::get('/admin', 'Admin\AdminController@index')->name('admin');

    Route::group(['middleware' => 'permission:crud roles'], function(){
        Route::resource('/admin/roles', 'Admin\AdminRoleController', ['names'=>[
            'index' => 'admin.roles.index',
            'create' => 'admin.roles.create',
            'store' => 'admin.roles.store',
            'show' => 'admin.roles.show',
            'edit' => 'admin.roles.edit',
            'update' => 'admin.roles.update',
            'destroy' => 'admin.roles.destroy'
        ]]);

        Route::post('/admin/roles/{role}/givePermission', 'Admin\AdminRoleController@givePermission')->name('admin.roles.givePermission');

        Route::post('/admin/roles/{role}/withdrawPermission', 'Admin\AdminRoleController@withdrawPermission')->name('admin.roles.withdrawPermission');
    });

    Route::group(['middleware' => 'permission:crud permissions'], function(){
        Route::resource('/admin/permissions', 'Admin\AdminPermissionController', ['names'=>[
            'index' => 'admin.permissions.index',
            'create' => 'admin.permissions.create',
            'store' => 'admin.permissions.store',
            'show' => 'admin.permissions.show',
            'edit' => 'admin.permissions.edit',
            'update' => 'admin.permissions.update',
            'destroy' => 'admin.permissions.destroy'
        ]]);
    });

    Route::group(['middleware' => 'permission:crud users'], function(){
        Route::resource('/admin/users', 'Admin\AdminUserController', ['names'=>[
            'index' => 'admin.users.index',
            'create' => 'admin.users.create',
            'store' => 'admin.users.store',
            'show' => 'admin.users.show',
            'edit' => 'admin.users.edit',
            'update' => 'admin.users.update',
            'destroy' => 'admin.users.destroy'
        ]]);

        Route::post('/admin/users/{user}/givePermission', 'Admin\AdminUserController@givePermission')->name('admin.users.givePermission');

        Route::post('/admin/users/{user}/withdrawPermission', 'Admin\AdminUserController@withdrawPermission')->name('admin.users.withdrawPermission');
    });

});
