<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', 'ProdutoControlador@index');

Route::post('/login', function(Request $req){
	$login_ok = false;

	switch($req->input('user')){
		case 'joao':
			$login_ok = $req->input('pass') === "senhajoao";
			break;
		case 'marco':
			$login_ok = $req->input('pass') === "senhamarcos";
			break;
		case 'default':
			$login_ok = false;
	}
	if($login_ok){
		return response("Login OK",200);

	}else{
		return response("Erro no login",404);
	}
});
