<?php

Route::get('/', function () {
    return view('index');
});

//Rotas para PRODUTOS
Route::get('/produtos','ControladorProduto@index');
Route::get('/produtos/novo','ControladorProduto@create');
Route::get('/produtos/remover/{id}','ControladorProduto@destroy');
Route::get('/produtos/editar/{id}','ControladorProduto@edit');
Route::post('/produtos/{id}','ControladorProduto@update');
Route::post('/produtos','ControladorProduto@store');

//Rotas para COMPRAS
Route::get('/compras/novo','ControladorCompra@create');
Route::get('/compras','ControladorCompra@index');
Route::post('/compras','ControladorCompra@store');

//Rotas para VENDAS
Route::get('/vendas','ControladorVenda@index');

//Rotas para RELATÒRIOS
Route::get('/relatorios','ControladorEstoque@index');

Route::get('/relatorios/totalizador','ControladorEstoque@tot');
