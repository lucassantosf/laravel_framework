
<?php

use Illuminate\Http\Request;

Route::get('/', function () {
    return "laravael";
});

Route::get('/ola', function () {
    return "Bem vindo";
});

Route::get('/ola/sejabemvindo', function () {
    return view('welcome');
});

Route::get('/nome/{nome}/{sobrenome}', function($nome,$sn){
	return "<h1>Ola $nome $sn!</h1>";
});

Route::get('/repetir/{nome}/{n}', function($nome,$n){
	
	if(is_integer($n)){
		for($i=0 ; $i < $n; $i++ ){
			echo "<h1>Ola vex $i $nome !</h1>";
		}
	}	
});

Route::get('/seunomecomregra/{nome}/{n}', function($nome,$n){
	
	for($i=0 ; $i < $n; $i++ ){
		echo "<h1>Ola vex $i $nome !</h1>";
	}		

})->where('n','[0-9]+')->where('nome','[A-za-z]+');

Route::get('/seunomesemregra/{nome?}', function($nome = null){
	if(isset($nome)){
		echo "<h1>Ola $nome !</h1>";
	}else{
		echo 'Não informou parametro';
	}
});
//exemplo de agrupamento de rotas
Route::prefix('app')->group(function(){

	Route::get("/", function(){
		return 'Pagina principal do app';
	});

	Route::get("/profile", function(){
		return 'Pagina principal do app/profile';
	});

	Route::get("/about", function(){
		return 'Pagina principal do app/about';
	});

});
//exemplo de redirecionamento de rotas
Route::redirect('/aqui','/ola',301);
/*
Route::view('/hello', function(){
	return view('hello');
});*/

//rota diretamente com o template
Route::view('/hello','hello');

Route::view('/viewnome','hellonome', [
	'nome'=>'Nome',
	'sobrenome'=>'Sobrenome'
]);

Route::get('/hellonome/{nome}/{sobrenome}',function($nome,$sn){
	return view('hellonome',[
		'nome'=>$nome,
		'sobrenome'=>$sn
	]);
});

Route::get('/rest/hello', function(){
	return "Hello GET";
});

Route::post('/rest/hello', function(){
	return "Hello POST";
});

Route::delete('/rest/hello', function(){
	return "Hello DELETE";
});

Route::put('/rest/hello', function(){
	return "Hello PUT";
});

Route::options('/rest/hello', function(){
	return "Hello OPTIONS";
});

Route::post('/rest/imprimir', function(Request $req){
	$nome = $req->input('nome');
	$idade = $req->input('idade');
	return "Hello $nome:: $idade anos (POST)";
});

Route::match(['get','post'],'/rest/hello2', function(){
	return 'Hello Word 2';
});

Route::any('/rest/hello3', function(){
	return 'Hello 3';
});