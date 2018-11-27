<?php

Route::get('/', function () {
    return view('pagina');
});

Route::get('/view', function(){
	return view('minhaView');
});

Route::get('/ola', function(){
	return view('minhaView')->with('nome','Lucas')->with('sobrenome','Ferreira');
});

Route::get('/ola/{nome}/{sobrenome}', function($nome,$sobrenome){
	/*
	return view('minhaView')->with('nome',$nome)->with('sobrenome',$sobrenome);*/
	
	//$param = ['nome'=>$nome,'sobrenome'=>$sobrenome];
	//return view('minhaView',$param);

	return view('minhaView', compact('nome','sobrenome'));
});

Route::get('/email/{email}',function($email){
if(View::exists('email')){
	return view('email', compact('email'));
}else 
	return view('erro');
});

Route::get('/produtos','ProdutoControlador@listar');

Route::get('/secaoprodutos/{palavra}','ProdutoControlador@secaoprodutos');

Route::get('/mostrar_opcoes','ProdutoControlador@mostrar_opcoes');

Route::get('/opcoes/{opcao}','ProdutoControlador@opcoes');

Route::get('/loop/for/{n}','ProdutoControlador@loopFor');

Route::get('/loop/foreach','ProdutoControlador@loopForEach');