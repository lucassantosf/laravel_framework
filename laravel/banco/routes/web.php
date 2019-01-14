<?php

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categorias',function(){
	$cats = DB::table('categorias')->get();

	foreach ($cats as $c) {
		echo "ID: ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<hr>";

	$nomes = DB::table('categorias')->pluck('nome');
	foreach ($nomes as $nome) {
		echo "$nome <br>";
	}

	echo "<hr>";

	$cat = DB::table('categorias')->where('id',5)->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<hr>";

	$cat = DB::table('categorias')->where('id',2)->first();
	echo "ID : ".$cat->id;
	echo $cat->nome." <br> ";

	echo "<p> Clausula LIKE</p>";
	$cat = DB::table('categorias')->where('nome','like','%i%')->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Sentença lógica OU</p>";
	$cat = DB::table('categorias')->where('id',1)->orWhere('id',2)->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Intervalos</p>";
	$cat = DB::table('categorias')->whereBetween('id',[1,7])->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Intervalos negacao</p>";
	$cat = DB::table('categorias')->whereNotBetween('id',[1,7])->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Dentro de um conjunto</p>";
	$cat = DB::table('categorias')->whereIn('id',[1,7])->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Fora de um conjunto</p>";
	$cat = DB::table('categorias')->whereNotIn('id',[1,7])->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p> Exemplo de diversos dados no Where</p>";
	$cat = DB::table('categorias')->where([
		['id',1],
		['nome','Info']
	])->get();
	
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p>Ordenando por nome</p>";
	$cat = DB::table('categorias')->where([
		['id',1]
	])->get();
	
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p>Ordenando por ORDER BY</p>";
	$cat = DB::table('categorias')->orderBy('nome')->get();	
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<p>Ordem descrescente por nome</p>";
	$cat = DB::table('categorias')->orderBy('nome','desc')->get();	
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

});

Route::get('/adicionar/{nome}', function($nome){

	$id = DB::table('categorias')->insertGetId([
		'nome'=>$nome
	]);
	echo "Last Id inserido ".$id;
});

Route::get('/atualizar/{id}/{nome}', function($id, $nome){

	$cat = DB::table('categorias')->where('id',$id)->first();
	echo "<p>Antes da atualização</p>";
	echo "ID : ".$cat->id;
	echo $cat->nome." <br> ";

	DB::table('categorias')->where('id',$id)->update([
		'nome'=>$nome
	]);

	$cat = DB::table('categorias')->where('id',$id)->first();
	echo "<p>Depois da atualização</p>";
	echo "ID : ".$cat->id;
	echo $cat->nome." <br> ";
});

Route::get('/apagar/{id}', function($id){
	echo "<p>Antes da remoçaõ</p>";

	$cat = DB::table('categorias')->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}

	echo "<br>";

	DB::table('categorias')->where('id',$id)->delete();

	echo "<p>Depois da remoção</p>";

	$cat = DB::table('categorias')->get();
	foreach ($cat as $c) {
		echo "ID ".$c->id." : ";
		echo $c->nome." <br> ";
	}
});
