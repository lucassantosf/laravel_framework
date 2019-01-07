<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/produtos', 'ProdutoControlador@index');

Route::get('/departamentos', 'Departamento@index');

Route::get('/user', function(){
	return view('usuario');
});