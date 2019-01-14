<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias', function(){
	$cats = DB::table('categorias')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}
	echo "<hr>";

	$nomes = DB::table('categorias')->pluck('nome');
	foreach ($nomes as $nome) {
		echo "$nome <br>";
	}
	echo "<hr>";

	//select * from categorias where id = 1
	echo "<p>Clausula Where</p>";
	$cats = DB::table('categorias')->where('id',1)->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Retornando um where com first</p>";
	$cats = DB::table('categorias')->where('id',1)->first();
	echo "ID: ".$cat->id." ";
	echo "NOME: ".$cat->nome." <br>";

	//
	echo "<hr>";
	echo "<p>Retornando um array com like</p>";
	$cats = DB::table('categorias')->where('nome','like','%c%')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Sentença lógica OR</p>";
	$cats = DB::table('categorias')->where('id',1)->orWhere('id',2)->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Intervalos</p>";
	$cats = DB::table('categorias')->whereBetween('id',[1,4])->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Intervalos negação</p>";
	$cats = DB::table('categorias')->whereNotBetween('id',[1,2])->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Where In - Conjuntos</p>";
	$cats = DB::table('categorias')->whereIn('id',[1,2,3])->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Where Not In - Conjuntos</p>";
	$cats = DB::table('categorias')->whereNotIn('id',[1,2,3])->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Sentença lógica</p>";
	$cats = DB::table('categorias')->where([
		['id',1],
		['nome','clothes']
	])->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Dados Ordenados por NOME</p>";
	$cats = DB::table('categorias')->orderBy('nome')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}

	echo "<hr>";
	echo "<p>Dados Ordenados por ID decrescente</p>";
	$cats = DB::table('categorias')->orderBy('id','desc')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}
});

Route::get('/categorias/nova/{nome}',function($nome){

	$id = DB::table('categorias')->insertGetId([
		'nome'=>$nome
	]);
	echo "Last Inserção de ID ".$id;
});

Route::get('/categorias/atualizar/{id}/{nomeUpd}',function($id,$nomeUpd){

	echo "<p>Antes de atualizar</p>";
	$cat = DB::table('categorias')->where('id',$id)->first();
	echo "ID: ".$cat->id." ";
	echo "NOME: ".$cat->nome." <br>";

	$cats = DB::table('categorias')->where('id',$id)->update(['nome'=>$nomeUpd]);

	echo "<p>Depois de atualizar</p>";
	$cat = DB::table('categorias')->where('id',$id)->first();
	echo "ID: ".$cat->id." ";
	echo "NOME: ".$cat->nome." <br>";

});

Route::get('/categorias/apagar/{id}',function($id){

	echo "<p>Todas categorias antes de apagar o id : $id</p>";
	$cats = DB::table('categorias')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}
	echo "<hr>";
	$cat = DB::table('categorias')->where('id',$id)->delete();

	echo "<p>Depois de apagar o id : $id</p>";
	$cats = DB::table('categorias')->get();
	foreach ($cats as $cat) {
		echo "ID: ".$cat->id." ";
		echo "NOME: ".$cat->nome." <br>";
	}
});