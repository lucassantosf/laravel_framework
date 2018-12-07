<?php

use App\Cliente;
use App\Endereco;

Route::get('/clientes', function () {
    $clientes = Cliente::all();
    foreach ($clientes as $c) {
    	echo "<p>ID:".$c->id."</p>";
    	echo "<p>Nome:".$c->nome."</p>";
    	echo "<p>Telefone:".$c->telefone."</p>";
    	//$e = Endereco::where('cliente_id',$c->id)->first();
    	echo "<p>Rua:".$c->endereco->rua."</p>";
    	echo "<p>Numero:".$c->endereco->numero."</p>";
    	echo "<p>Bairro:".$c->endereco->bairro."</p>";
    	echo "<p>Cidade:".$c->endereco->cidade."</p>";
    	echo "<p>Uf:".$c->endereco->uf."</p>";
    	echo "<p>CEP:".$c->endereco->cep."</p>";
    	echo "<hr>";
    }
});

Route::get('/enderecos', function () {
    $es = Endereco::all();
    foreach ($es as $c) {
    	echo "<p>ID do cliente:".$c->cliente_id."</p>";
    	echo "<hr>";
    	echo "<p>Nome:".$c->cliente->nome."</p>";
    	echo "<p>Telefone:".$c->cliente->telefone."</p>";
    	echo "<hr>";
    	echo "<p>Rua:".$c->rua."</p>";
    	echo "<p>Numero:".$c->numero."</p>";
    	echo "<p>Bairro:".$c->bairro."</p>";
    	echo "<p>Cidade:".$c->cidade."</p>";
    	echo "<p>Uf:".$c->uf."</p>";
    	echo "<p>CEP:".$c->cep."</p>";
    	echo "<hr>";
    }
});


Route::get('/inserir', function(){
	
	$c = new Cliente();
	$c->nome = "Jos Ros";
	$c->telefone = "11 1111111234";
	$c->save();
	
	$e = new Endereco();
	$e->rua = "Avenida do Estado";
	$e->numero = 333;
	$e->bairro = "Bairro limao";
	$e->cidade = "Cidade a";
	$e->uf = "SP";
	$e->cep = "asd132";

	$c->endereco()->save($e);

	$c = new Cliente();
	$c->nome = "Axl";
	$c->telefone = "11 142321234";
	$c->save();
	
	$e = new Endereco();
	$e->rua = "Avenida do Bandeira flag";
	$e->numero = 312;
	$e->bairro = "Bairro goiava";
	$e->cidade = "Cidade B";
	$e->uf = "AM";
	$e->cep = "1443132";

	$c->endereco()->save($e);
});

Route::get('/clientes/json', function(){
	//$clientes = Cliente::all(); lazy loading
	$clientes = Cliente::with(['endereco'])->get();//eager loading
	return json_encode($clientes);
});

Route::get('/enderecos/json', function(){
	//$end = Endereco::all(); //lazyloading
	$end = Endereco::with(['cliente'])->get();//eager loading
	return json_encode($end);
});

