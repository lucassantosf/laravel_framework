<?php

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ola', function () {
    return 'Seja bem vindo';
});

Route::get('/ola/ola', function () {
    return 'Seja bem vindo ola ola';
});

Route::get('/nome/{nome}/{sobrenome}', function($nome,$sobrenome){
	return "<h1>Ola $nome $sobrenome</h1>".imprimir($nome);
});

Route::get('/repetir/{nome}/{n}', function($nome,$n){
	if(is_integer($n)){
		for($i=0; $i<$n; $i++ ){
			echo "<h1>Ola $nome</h1>".imprimir($nome);
		}
	}else{
		echo "Informe um numero para parametro N";
	}
	
});

Route::get('/regra/{nome}/{n}', function($nome,$n){

	for($i=0; $i<$n; $i++ ){
		echo "<h1>Ola $nome</h1>";
	}

})->where('n','[0-9]+')->where('nome','[A-Za-z]+');

Route::get('/semregra/{nome?}', function($nome=null){
	if(isset($nome)){
		
		echo "<h1>Ola $nome</h1>";

	}else{
		echo 'Informe um nome';
	}

});

Route::prefix('app')->group(function(){
	Route::get("/",function(){
		return view('hello');
	});
	Route::get("/profile",function(){
		return 'Profile';		
	});
	Route::get("/about",function(){
		return 'sobre';		
	});
});

Route::view('/hello','hello',[
		'nome'=>'Nome','sobrenome'=>'Sobrenome'
]);

Route::get('/hello/{nome}/{sobrenome}', function($nome,$sn){
	return view('hello',[
		'nome'=>$nome,'sobrenome'=>$sn
		]);
});

Route::redirect('/aqui','/app', 301);

function imprimir($vr){
	echo "$vr";
}