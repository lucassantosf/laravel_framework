<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin','AdminController@index')->name('admin.dashboard');

Route::get('/admin/login','Auth\AdminLoginController@index')->name('admin.login');

Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');