<?php

Route::get('/', function () {
    return view('pagina');
});

Route::get('/minhaview',function(){
	return view('minhaview');
});

Route::get('/ola',function(){
	return view('minhaview')->with('nome','Lucas')->with('sobrenome','Ferreira');
});

Route::get('/ola/{nome}/{sobrenome}',function($nome,$sobrenome){
	
	//return view('minhaview')->with('nome',$nome)->with('sobrenome',$sobrenome);
	$parametros = ['nome'=>$nome,'sobrenome'=>$sobrenome];
	return view('minhaview',compact('nome','sobrenome'));
});

Route::get('/email/{email}',function($email){

	if(View::exists('email'))
		return view('email', compact('email'));
	else
		return view('erro');
});

Route::get('/produtos','ProdutoControlador@listar');

Route::get('/secaoprodutos/{coisa}','ProdutoControlador@secaoprodutos');

Route::get('/mostrar_opcoes','ProdutoControlador@mostrar_opcoes');

Route::get('/opcoes/{opc}','ProdutoControlador@escolher_opcoes');

Route::get('/for/{n}','ProdutoControlador@laco');

Route::get('/loop/foreach','ProdutoControlador@loop');