<?php
Route::get('/novocliente', 'ClienteControlador@create');

Route::get('/', 'ClienteControlador@index');

Route::post('/cliente','ClienteControlador@store');
