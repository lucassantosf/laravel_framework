<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', function(){
	
	//Exemplo de consulta de registros em banco
	$cats = DB::table('categorias')->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}
	
	echo "<hr>";

	$nomes = DB::table('categorias')->pluck('nome');
	foreach ($nomes as $nome) {
		echo "$nome <br>";
	}

	echo "<hr>";

	$cats = DB::table('categorias')->where('id',1)->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<hr>";

	$cats = DB::table('categorias')->where('id',1)->first();
	echo "id: ".$cat->id."; ";
	echo "nome: ".$cat->nome."<br>";
	
	echo "<p>Array com like</p>";
	$cats = DB::table('categorias')->where('nome','like','%p%')->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Sentenças lógicas</p>";
	$cats = DB::table('categorias')->where('id',1)->orWhere('id',2)->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Intervalos</p>";
	$cats = DB::table('categorias')->whereBetween('id',[1,2])->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Intervalos</p>";
	$cats = DB::table('categorias')->whereNotBetween('id',[1,2])->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Intervalos</p>";
	$cats = DB::table('categorias')->whereIn('id',[1,3,4])->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Intervalos</p>";
	$cats = DB::table('categorias')->whereNotIn('id',[1,3,4])->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Sentenças lógicas</p>";
	$cats = DB::table('categorias')->where([
		['id',1],
		['nome','Roupas']
	])->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Ordenando por nomes</p>";
	$cats = DB::table('categorias')->orderBy('id')->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

	echo "<p>Ordenando por id decrescente</p>";
	$cats = DB::table('categorias')->orderBy('id','desc')->get();
	foreach ($cats as $cat) {
		echo "id: ".$cat->id."; ";
		echo "nome: ".$cat->nome."<br>";
	}

});

Route::get('/novascategorias',function(){
	$id = DB::table('categorias')->insertGetId(
		['nome'=>'Carros']
	);
	echo "ùltimo id inserido - $id";
});