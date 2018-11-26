<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MeuControlador extends Controller
{
    
    public function getNome(){
    	return 'Teste d Nome';
    }

    public function getIdade(){
    	return "222 anos";
    }

    public function multiplicar($n1,$n2){
    	return $n1 * $n2;
    }

    public function getNomeByID($id){
    	$v = ["nome1","nome2","nome3","nome4"];
    	if($id >= 0 && $id < count($v)){
    		return $v[$id];
    	} else{
    		return "Nao encontrado";
    	}
    }
}
