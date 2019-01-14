<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrimeiroControlador extends Controller
{
    
    public function index(){
    	return 'Aaaaa alno';
    }

    public function getidade(){
    	return '20 anos';
    }

    public function multiplicar($n1,$n2){
    	return $n1*$n2;
    }

    public function getNomeById($id){
    	$v = ["Nome1","nome2","nome3","nome4","nome5"];
    	if($id>= 0 && $id < count($v)){
    		return $v[$id];
    	}else{
    		return "Id inválido";
    	}
    }
}
