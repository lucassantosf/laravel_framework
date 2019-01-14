<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/nome', 'PrimeiroControlador@index');

Route::get('/idade', 'PrimeiroControlador@getidade');

Route::get('/multiplicar/{n1}/{n2}', 'PrimeiroControlador@multiplicar');

Route::get('/localizarNome/{id}','PrimeiroControlador@getNomeById');

Route::resource('/cliente','ClienteControlador');

Route::post('/cliente2','ClienteControlador@requisitar');
