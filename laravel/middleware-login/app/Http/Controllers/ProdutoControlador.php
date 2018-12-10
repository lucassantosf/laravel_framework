<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{	
	private $produtos = ["Televisao","Note","Tonner","Caneta"];

    public function index(){
    	echo "<h3>Produtos</h3>";
    	echo "<ol>";
    	foreach ($this->produtos as $p) {
    		echo "<li>";
    			echo $p."</br>";
    		echo "</li>";
    	}
    	echo "</ol>";
    }
}
