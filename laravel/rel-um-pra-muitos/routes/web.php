<?php

use App\Produto;
use App\Categoria;

Route::get('/categorias', function () {
    $cat = Categoria::all();
    if(!count($cat)>0){
    	echo "Nenhuma categoria cadastrada";
    }else{
    	foreach ($cat as $c) {
    		echo "<p>".$c->id.$c->nome."</p>";
   		}
   	}
});

Route::get('/categoriasprodutos', function () {
    $cat = Categoria::all();
    if(!count($cat)>0){
    	echo "Nenhuma categoria cadastrada";
    }else{
    	foreach ($cat as $c) {
    		echo "<p>".$c->id.$c->nome."</p>";
    		$produtos = $c->produtos;
    		if(count($produtos)>0){
    			echo "<ul>";
    			foreach ($produtos as $p) {
    				echo "<li>".$p->nome."</li>";
    			}
    			echo "</ul>";
    		}
   		}
   	}
});

Route::get('/produtos', function () {
    $prods = Produto::all();
    if(!count($prods)>0){
    	echo "Nenhuma produto cadastrado";
    }else{
    	echo "<table>";
    	echo "<thead><tr> <td>Nome</td> <td>Estoque</td> <td>Preco</td> <td>Categoria</td> </tr>";
     	foreach ($prods as $p) {
     		echo "<tr>";
    		echo "<td>".$p->nome."</td>";
    		echo "<td>".$p->estoque."</td>";
    		echo "<td>".$p->preco."</td>";
    		echo "<td>".$p->categoria->nome."</td>";
    		echo "</tr>";
   		}
   	}
});

Route::get('/categoriasprodutos/json', function () {
	$cats = Categoria::with('produtos')->get();
	return json_encode($cats);
});

Route::get('/adicionarproduto', function () {
	$cat = Categoria::find(1);
	$p = new Produto();
	$p->nome = "Novo produto";
	$p->estoque = 3;
	$p->preco = 122;
	$p->categoria()->associate($cat);
	$p->save();
	return json_encode($p);
});

Route::get('/removerproduto', function () {
	$p = Produto::find(9);
	if(isset($p)){
		$p->categoria()->dissociate();
		$p->save();
		return json_encode($p);
	}
	return '';	
});

Route::get('/adicionarproduto/{cat}', function ($catid) {
	$cat = Categoria::with('produtos')->find($catid);
	
	$p = new Produto();
	$p->nome = "Novo produto adicionado 5";
	$p->estoque = 3;
	$p->preco = 122;
	
	if(isset($cat)){
		$cat->produtos()->save($p);
	}
	$cat->load('produtos');
	return $cat->toJson();
});