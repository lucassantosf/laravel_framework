<?php

//Route::get('/', 'ClienteControlador@index');

Route::get('/', 'ClienteControlador@indexjs');

Route::get('/json', 'ClienteControlador@indexjson');
