<?php

Auth::routes();

Route::get('auth/activate', 'Auth\ActivationController@activate')->name('auth.activate');

Route::get('auth/activate/resend', 'Auth\ActivationResendController@showResendForm')->name('auth.activate.resend');

Route::post('auth/activate/resend', 'Auth\ActivationResendController@resend');

Route::get('/', 'HomeController@index')->name('home');

Route::get('/product', 'HomeController@product')->name('home.product');


Route::get('/admin', 'AdminController@index')->name('admin');