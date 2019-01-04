<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos','ProdutoControlador@index');

Route::get('/negado',function(){
	return 'Acesso negado';
})->name('negado');

Route::post('/login',function(Request $req){
	$login_ok = false;
	$admin = false;
	switch ($req->input('user')) {
		case 'user1':
			$login_ok = $req->input('password') === "senha1";
			break;
		case 'user2':
			$login_ok = $req->input('password') === "senha2";
			$admin = true;
			break;
		
		default:
			$login_ok = false;
			break;
	}
	if($login_ok){

		$login = ['user'=> $req->input('user'),'admin'=>$admin];
		$req->session()->put('login',$login);

		return response('login OK',200);
	}else{
		$req->session()->flush();

		return response('Erro no login', 404);
	}
});

Route::get('/logout', function(Request $req){
	$req->session()->flush();
	return response('Deslogado com sucesso',200);
});
