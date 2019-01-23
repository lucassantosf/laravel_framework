<?php

Route::get('/', 'LoginController@index');

//Direcionamento do Logout
Route::get('logout', 'LoginController@logout');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@index')->name('admin.dash');

Route::get('/admin/login', 'Auth\AdminLoginController@index')->name('admin.login');

Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('/teste','LoginController@index');

// Cadastros
Route::get('/cadastros/user','CadastrosController@indexUser');
Route::get('/cadastros/user/{id}/edit','CadastrosController@formUserEdit');
Route::post('/cadastros/user/{id}/edit','CadastrosController@postFormUserEdit');
Route::get('/cadastros/user/{id}/delete','CadastrosController@destroyUser');
Route::get('/cadastros/formUser','CadastrosController@formUser');
Route::post('/cadastros/formUser','CadastrosController@postFormUser');

Route::get('/cadastros/plans','CadastrosController@indexPlans');

Route::get('/cadastros/products','CadastrosController@indexProducts');

Route::get('/cadastros/modals','CadastrosController@indexModals');


// Relatórios


// Clientes e Incluir Clientes
Route::get('/clients','CadastrosController@indexClients');

Route::get('/incluir/clients','CadastrosController@indexClientsAdd');
