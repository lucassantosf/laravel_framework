<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    
    public function listar(){

    	$produtos = [
    		"Notebook",
    		"Mouse",
    		"Teclado",
    		"Monitor",
    		"Impressora",
    		"HD"
    	];

    	return view('produtos', compact('produtos'));
    }

    public function secaoprodutos($palavra){
    	return view('secao_produtos',compact('palavra'));
    }

    public function mostrar_opcoes(){
    	return view('mostrar_opcoes');
    }

    public function opcoes($opcao){
    	return view('opcoes',compact('opcao'));
    }

    public function loopFor($n){
    	return view('loop_for',compact('n'));
    }

    public function loopForEach(){
    	$produtos = [
    		["id"=>1,"nome"=>"computador"],
    		["id"=>2,"nome"=>"mouse"],
    		["id"=>3,"nome"=>"impressora"],
    		["id"=>4,"nome"=>"monitor"],
    		["id"=>5,"nome"=>"teclado"]
    	];
    	return view('forEach',compact('produtos'));
    }
}
