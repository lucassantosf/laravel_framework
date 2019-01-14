<?php

use App\Categoria;

Route::get('/', function () {
    $categorias = Categoria::all();
    foreach ($categorias as $c) {
    	echo $c->id." ";
    	echo $c->nome. "<br>";
    }
});

Route::get('/inserir/{nome}',function($nome){
	$cat = new Categoria();
	$cat->nome = $nome;
	$cat->save();
	return redirect('/');
});

Route::get('/buscar/{id}',function($id){
	$c = Categoria::find($id);
	if(isset($c)){
		echo $c->id." ";
    	echo $c->nome. "<br>";
	}else{
		echo "Categoria não localizada";
	}	
});

Route::get('/atualizar/{id}/{nome}',function($id,$nome){
	$c = Categoria::find($id);
	if(isset($c)){
		$c->nome = $nome;
		$c->save();
		return redirect('/');
	}else{
		echo "Categoria não localizada";
	}	
});

Route::get('/apagar/{id}',function($id){
	$c = Categoria::find($id);
	if(isset($c)){
		$c->delete();
		return redirect('/');
	}else{
		echo "Categoria não localizada";
	}	
});

Route::get('/procurarnome/{nome}',function($nome){
	$categorias = Categoria::where('nome',$nome)->get();
	foreach ($categorias as $c) {
    	echo $c->id." ";
    	echo $c->nome. "<br>";
    }	
});

Route::get('/procurarid/{nome}',function($id){
	$categorias = Categoria::where('id','>',$id)->get();
	foreach ($categorias as $c) {
    	echo $c->id." ";
    	echo $c->nome. "<br>";
    }	

	$count = Categoria::where('id','>',$id)->count();
	echo "Total de : ".$count;
	echo "<br>";
	$max = Categoria::where('id','>',$id)->max('id');
	echo "ID Máximo : ".$max;
});

Route::get('/conjunto',function(){
	$categorias = Categoria::find([1,2,3]);
	foreach ($categorias as $c) {
    	echo $c->id." ";
    	echo $c->nome. "<br>";
    }	
});

Route::get('/todas', function () {
    $categorias = Categoria::withTrashed()->get();
    foreach ($categorias as $c) {
    	echo $c->id." ";
    	if($c->trashed()){
    		echo "deletado em :".$c->deleted_at;
    	}
    	echo $c->nome. "<br>";
    }
});

Route::get('/show/{id}',function($id){
	//$c = Categoria::withTrashed()->find($id);
	$c = Categoria::withTrashed()->where('id',$id)->get()->first();	
	if(isset($c)){
		echo $c->id." ";
    	echo $c->nome. "<br>";
	}else{
		echo "Categoria não localizada";
	}	
});

Route::get('/apagadas',function(){
	//$c = Categoria::withTrashed()->find($id);
	$apagadas = Categoria::onlyTrashed()->get();	
	foreach ($apagadas as $c) {
    	echo $c->id." ";
    	if($c->trashed()){
    		echo "deletado em : ".$c->deleted_at." ";
    	}
    	echo $c->nome. "<br>";
    }	
});

Route::get('/restaurar/{id}',function($id){
	$c = Categoria::withTrashed()->find($id);	
	if(isset($c)){
		$c->restore();
		echo "Restaurado o ";
		echo $c->id." ";
    	echo $c->nome. "<br>";
	}else{
		echo "Categoria não localizada";
	}	
});


Route::get('/apagarPermanente/{id}',function($id){
	$c = Categoria::withTrashed()->find($id);	
	if(isset($c)){
		$c->forceDelete();
		return redirect('/');
	}else{
		echo "Categoria não localizada";
	}	
});

