<?php

//use App\Http\Middleware\PrimeiroMiddleware;

Route::get('/usuarios', 'UsuarioControlador@index')->middleware('primeiro','segundo');

Route::get('/terceiro', function () {
    return 'Passou pelo terceiro';
})->middleware("terceiro:LL,2");

