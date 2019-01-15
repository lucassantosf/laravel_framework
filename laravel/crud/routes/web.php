<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/produtos','ControladorProduto@index');

Route::get('/compras','ControladorCompra@index');

Route::get('/vendas','ControladorVenda@index');

Route::get('/relatorios','ControladorEstoque@index');
