<?php

use App\Produto;
use App\Categoria;

Route::get('/categorias', function () {
    
    $cat = Categoria::all();
    if(count($cat)>0){
    	foreach ($cat as $c) {
    		echo "<p>".$c->id." ".$c->nome."</p>";    		
    	}
    }

});

Route::get('/produtos', function () {
    
    $prods = Produto::all();
    if(count($prods)>0){
    	echo "<table border='1'>";
    	echo "<thead><tr> <td>Nome</td> <td>Estoque</td> <td>Preco</td> <td>Categoria</td></tr> </thead>";
    	foreach ($prods as $p) {
    		echo "<tr>";
    		echo "<td>".$p->nome."</td>";   
    		echo "<td>".$p->estoque."</td>";   
    		echo "<td>".$p->preco."</td>";   
    		echo "<td>".$p->categoria->nome."</td>";   
    		echo "</tr>"; 		
    	}
    	echo "</table>";    	
    }
});

Route::get('/categoriasprodutos', function () {
    
    $cat = Categoria::all();
    if(count($cat)>0){
    	foreach ($cat as $c) {
    		echo "<p>".$c->id." ".$c->nome."</p>";    	
    		
    		$produtos = $c->produtos;
    		
    		if(count($produtos) > 0){
    			echo "<ul>";
    				foreach ($produtos as $p) {
    					echo "<li>".$p->nome."</li>";
    				}
    			echo "</ul>";
    		}	
    	}
    }

});

Route::get('/categoriasprodutos/json',function(){
	$cats = Categoria::with('produtos')->get();
	return $cats->toJson();
});

Route::get('/adicionarproduto',function(){
	
	$cat = Categoria::find(1);

	$p = new Produto();
	$p->nome = "Meu novo produt";
	$p->preco = 332;
	$p->estoque = 10;
	$p->categoria()->associate($cat);
	$p->save();

	return $p->toJson();
});

Route::get('/removerproduto',function(){
	
	$p = Produto::find(9);
	if(isset($p)){
		$p->categoria()->dissociate();
		$p->save();
		return $p->toJson();
	}
});

Route::get('/adicionarproduto/{cat_id}',function($cat_id){
	$cat = Categoria::with('produtos')->find($cat_id);

	$p = new Produto();
	$p->nome = "Meu novo produt add";
	$p->preco = 332;
	$p->estoque = 10;
	$p->categoria()->associate($cat_id);

	if(isset($cat)){
		$cat->produtos()->save($p);
	}
	
	$cat->load('produtos');

	return $cat->toJson();
});
