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

    Route::get('/admin/media', 'Admin\AdminMediaController@index')->name('admin.media.index');

    Route::delete('/admin/media/{photo}', 'Admin\AdminMediaController@destroy')->name('admin.media.destroy');

    Route::resource('/admin/categories', 'Admin\AdminCategoryController', ['names'=>[
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'show' => 'admin.categories.show',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy'
    ]]);

    Route::post('/admin/categories/{category}/storeSubCategory', 'Admin\AdminCategoryController@storeSubCategory')->name('admin.categories.storeSubCategory');

    Route::resource('/admin/subCategories', 'Admin\AdminSubCategoryController', ['names'=>[
        'index' => 'admin.subCategories.index',
        'create' => 'admin.subCategories.create',
        'store' => 'admin.subCategories.store',
        'show' => 'admin.subCategories.show',
        'edit' => 'admin.subCategories.edit',
        'update' => 'admin.subCategories.update',
        'destroy' => 'admin.subCategories.destroy'
    ]]);

    Route::resource('/admin/brands', 'Admin\AdminBrandController', ['names'=>[
        'index' => 'admin.brands.index',
        'create' => 'admin.brands.create',
        'store' => 'admin.brands.store',
        'show' => 'admin.brands.show',
        'edit' => 'admin.brands.edit',
        'update' => 'admin.brands.update',
        'destroy' => 'admin.brands.destroy'
    ]]);

    Route::resource('/admin/products', 'Admin\AdminProductController', ['names'=>[
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'show' => 'admin.products.show',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy'
    ]]);

    Route::post('/admin/products/{product}/addSubCategory', 'Admin\AdminProductController@addSubCategory')->name('admin.products.addSubCategory');

    Route::post('/admin/products/{product}/withdrawSubCategory', 'Admin\AdminProductController@withdrawSubCategory')->name('admin.products.withdrawSubCategory');

    Route::post('/admin/products/ajaxSubCategory', 'Admin\AdminProductController@ajaxSubCategory')->name('admin.products.ajaxSubCategory');

    Route::get('/admin/products/{product}/showPhotos', 'Admin\AdminProductController@showPhotos')->name('admin.products.showPhotos');

    Route::post('/admin/products/{product}/addPhoto', 'Admin\AdminProductController@addPhoto')->name('admin.products.addPhoto');

    Route::delete('/admin/products/{product}/deletePhoto', 'Admin\AdminProductController@deletePhoto')->name('admin.products.deletePhoto');

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
