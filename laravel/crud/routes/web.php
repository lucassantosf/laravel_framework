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