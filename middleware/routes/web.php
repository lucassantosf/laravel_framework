<?php

//use App\Http\Middleware\PrimeiroMiddleware;

Route::get('/', function () {
    return view('welcome');
});

//protegendo com o middleware
Route::get('/usuarios', 'UsuarioControlador@index')->middleware('primeiro','segundo');

Route::get('/terceiro/{nome}/{idade}',function($nome,$idade){
	return 'Terceiro Middlware '.$nome.' e idade:'.$idade;
})->middleware("terceiro");
