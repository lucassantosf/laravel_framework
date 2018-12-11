<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos', 'ProdutoControlador@index');

Route::get('/negado', function(){
	return "Acesso negado";
})->name('negado');

Route::get('/negadoLogin', function(){
	return "Acesso negado, area administrativa";
})->name('negadoLogin');

Route::post('/login', function(Request $req){
	$login_ok = false;
	$admin = false;
	switch($req->input('user')){
		case 'joao':
			$login_ok = $req->input('pass') === "senhajoao";
			$admin = true;
			break;
		case 'marco':
			$login_ok = $req->input('pass') === "senhamarcos";
			break;
		case 'default':
			$login_ok = false;
	}
	if($login_ok){
		$login = ['user'=>$req->input('user'),'admin'=>$admin];
		$req->session()->put('login',$login);
		return response("Login OK",200);
	}else{
		$req->session()->flush();
		return response("Erro no login",404);
	}
});

Route::get('/logout', function(Request $request){
	$request->session()->flush();
	return response('Deslogado',200);
});