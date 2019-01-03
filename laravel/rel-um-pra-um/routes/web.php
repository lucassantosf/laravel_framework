<?php

use App\Cliente;
use App\Endereco;

//Relacionamento UM para UM -> HasOne

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach ($clientes as $c) {
    	echo "<p>ID:".$c->id."</p>";
    	echo "<p>Nome:".$c->nome."</p>";
    	echo "<p>Telefone:".$c->telefone."</p>";
    	//relacionamento um pra um
    	echo "<p>Nome da rua:".$c->endereco->rua."</p>";
	    echo "<p>Numero:".$c->endereco->numero."</p>";
	    echo "<p>Bairro:".$c->endereco->bairro."</p>";
	    echo "<p>Cidade:".$c->endereco->cidade."</p>";
	    echo "<p>Uf:".$c->endereco->uf."</p>";
	    echo "<p>Cep:".$c->endereco->cep."</p>";    	
    	echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $addresses = Endereco::all();
    foreach ($addresses as $a) {
    	echo "<p>ID do cliente:".$a->cliente_id."</p>";
    	
    	//belongsTo
    	echo "<p>Cliente neste endereco:".$a->cliente->nome."</p>";
    	echo "<p>Telefone:".$a->cliente->telefone."</p>";
    	
    	echo "<p>Nome da rua:".$a->rua."</p>";
    	echo "<p>Numero:".$a->numero."</p>";
    	echo "<p>Bairro:".$a->bairro."</p>";
    	echo "<p>Cidade:".$a->cidade."</p>";
    	echo "<p>Uf:".$a->uf."</p>";
    	echo "<p>Cep:".$a->cep."</p>";
    	echo "<hr>";
    }
});

Route::get('/inserir', function(){
	
	$c = new Cliente();
	$c->nome = "Jos Berine";
	$c->telefone = "11 2233 3322";
	$c->save();

	$e = new Endereco();
	$e->rua = "Avenida Daada";
	$e->numero = 12333;
	$e->bairro = "Centro";
	$e->cidade = "São Paulo";
	$e->uf = "SP";
	$e->cep = "3213232";
	
	//inserir relacionamento
	$c->endereco()->save($e);

});

Route::get('/clientes/json',function(){
	//$clientes = Cliente::all(); //lazyloading
	//relacionamento com EagerLoading
	$clientes = Cliente::with(['endereco'])->get();
	return $clientes->toJson();
});

Route::get('/enderecos/json',function(){
	
	//$enderecos = Endereco::all(); //lazyloading
	
	$enderecos = Endereco::with(['cliente'])->get(); //relacionamento com EagerLoading
	
	return $enderecos->toJson();
});
