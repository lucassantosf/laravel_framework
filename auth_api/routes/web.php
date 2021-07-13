<?php
/* ROUTES SITE */
Route::get('/', 'DashboardController@home')->name('home');
Route::get('/trocarsenha/{token}', 'Api\ResetPasswordController@showResetForm')->name('usuarios.changepw');
Route::post('/confirm', 'Api\ResetPasswordController@reset')->name('usuarios.updatepw');
Route::get('/success', 'Api\ResetPasswordController@redirect')->name('usuarios.successpw');
Route::get('/clearcache', function() {
    Artisan::call('cache:clear'); 
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

/* ROUTES AUTHENTICATE */
Route::group(['prefix'=>'cms'], function(){
	Auth::routes();
});

/* ROUTES CMS */
Route::group(['prefix'=>'cms','middleware' => 'auth'], function(){
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');

	//Dynamic Content
	Route::resource('especialidades', 'EspecialidadesController');
	Route::resource('pacotes', 'PacotesController');
	Route::resource('informacoes', 'InformacoesController');
	Route::resource('usuarios', 'UsersController');

	//Filtros
	Route::get('buscar/especialidade', 'FiltrosController@especialidadebusca')->name('especialidades.busca');
});
