<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
    public function listar(){
    	$produtos = [
    		"Note","Television","Mouse","Teclado","Pen","Eraser","Bus Stop","Printer"
    	];
    	return view('produtos',compact('produtos'));
    }

    public function secaoprodutos($coisas){
    	return view('secao_produtos',compact('coisas'));
    }

    public function mostrar_opcoes(){
    	return view('mostrar_opcoes');
    }

    public function escolher_opcoes($opc){
    	return view('opcoes',compact('opc'));
    }

    public function laco($n){
    	$produtos = [
    		"Note","Television","Mouse","Teclado","Pen","Eraser","Bus Stop","Printer"
    	];
    	return view('loop_for',compact('n','produtos'));
    }

    public function loop(){
    	$produtos = [
    		["id"=>1,"nome"=>"Television"],
    		["id"=>2,"nome"=>"Mouse"],
    		["id"=>3,"nome"=>"Eraser"],
    		["id"=>4,"nome"=>"Bus"]
    	];
    	return view('foreach',compact('produtos'));
    }
}
