<?php

use App\Categoria;

Route::get('/', function () {
    $cats = Categoria::all();
    foreach ($cats as $c) {
		echo "Id : ".$c->id;
    	echo " Nome: ".$c->nome."<br>";
    }
});

Route::get('/inserir/{nome}', function($nome){
	$cat = new Categoria();
	$cat->nome = $nome;
	$cat->save();
	return redirect('/');
});

Route::get('/recuperar/{id}',function($id){
	$cat = Categoria::find($id);

	if (isset($cat)) {
		echo "Nome : ".$cat->nome;
	}else{
		echo "Categoria não existente";
	}
});

Route::get('/atualizar/{id}/{nome}',function($id,$nome){
	$cat = Categoria::find($id);

	if (isset($cat)) {
		$cat->nome = $nome;
		$cat->save();
		return redirect('/');
	}else{
		echo "Categoria não existente";
	}
});

Route::get('/remover/{id}',function($id){
	$cat = Categoria::find($id);

	if (isset($cat)) {
		$cat->delete();
		return redirect('/');
	}else{
		echo "Categoria não existente";
	}
});

Route::get('/procurar/{nome}',function($nome){
	$cats = Categoria::where('nome',$nome)->get();	

	foreach ($cats as $c) {
		echo "Id : ".$cat->id;		
    	echo "Nome: ".$c->nome."<br>";
    }

    $count = Categoria::where('id','>',1)->count();
    echo "Count: ".$count;
});

Route::get('/procurarm/{id}',function($id){
	$cats = Categoria::where('id','>',$id)->get();	
	foreach ($cats as $c) {
    	echo "Nome: ".$c->nome."<br>";
    }
});

Route::get('/todas', function () {
    $cats = Categoria::withTrashed()->get();
    foreach ($cats as $c) {
    	echo "Nome: ".$c->nome."<br>";
    	if($c->trashed())
    		echo 'apagado <br>';
    	else
    		echo '<br>';
    }
});


Route::get('/show/{id}',function($id){
	//$cat = Categoria::withTrashed($id)->find($id);
	$cat = Categoria::withTrashed($id)->where('id',$id)->get()->first();
	
	if (isset($cat)) {
		echo "Nome : ".$cat->nome;
	}else{
		echo "Categoria não existente";
	}
});

Route::get('/somentedelete', function () {
    $cats = Categoria::onlyTrashed()->get();
    foreach ($cats as $c) {
		echo "Id : ".$cat->id;
    	echo "Nome: ".$c->nome."<br>";
    	if($c->trashed())
    		echo 'apagado <br>';
    	else
    		echo '<br>';
    }
});

Route::get('/restaurar/{id}',function($id){
	$cat = Categoria::withTrashed($id)->find($id);
	
	if (isset($cat)) {
		$cat->restore();
		echo "Id : ".$cat->id;
		echo " Nome : ".$cat->nome;
	}else{
		echo "Categoria não existente";
	}
});

Route::get('/apagarpermanente/{id}',function($id){
	$cat = Categoria::withTrashed($id)->find($id);
	
	if (isset($cat)) {
		$cat->forceDelete();
		echo "Id : ".$cat->id;
		echo " Nome : ".$cat->nome;
		return redirect('/');
	}else{
		echo "Categoria não existente";
	}
});