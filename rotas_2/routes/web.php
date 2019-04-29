<?php

use Illuminate\Http\Request;

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

Route::get('/rest/hello', function(){

	return "Hello (GET)";
});

Route::post('/rest/hello', function(){
	return "Hello POST";
});

Route::delete('/rest/hello', function(){
	return "Hello DELETE";
});

Route::put('/rest/hello', function(){
	return "Hello DELETE";
});

Route::post('/rest/imprimir', function(Request $req){
	$nome = $req->input('name');
	return "Hello $nome";
});

Route::match(['get','post'],'/rest/hello2', function(){
	return 'Hello Word 2';
});

Route::any('/rest/hello3',function(){
	return "Hello3";
});

Route::get('/produtos', function(){
	echo "<h1>Produtos</h1>";
	echo "<ol>Produtos</h1>";
		echo "<li>Notebook</li>";
		echo "<li>Impressoras</li>";
		echo "<li>Mouse</li>";
	echo "</ol";	
})->name('meuprodutos');

Route::get('linkprodutos', function(){
	$url = route('meuprodutos');
	echo "<a href=\"".$url."\">Meus produtos</a>";
});

Route::get("/redirecionar",function(){
	return redirect()->route('meuprodutos');
});

function imprimir($vr){
	echo "$vr";
};