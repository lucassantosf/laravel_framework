<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/produtos','ControladorProduto@index');

Route::get('/categorias','ControladorCategoria@index');

Route::get('/produtos/novo','ControladorProduto@create');

Route::get('/categorias/novo','ControladorCategoria@create');

Route::post('/produtos','ControladorProduto@store');

Route::post('/categorias','ControladorCategoria@store');

Route::get('/produtos/apagar/{id}','ControladorProduto@destroy');

Route::get('/categorias/apagar/{id}','ControladorCategoria@destroy');

Route::get('/produtos/editar/{id}','ControladorProduto@edit');

Route::get('/categorias/editar/{id}','ControladorCategoria@edit');

Route::post('/produtos/{id}','ControladorProduto@update');

Route::post('/categorias/{id}','ControladorCategoria@update');

