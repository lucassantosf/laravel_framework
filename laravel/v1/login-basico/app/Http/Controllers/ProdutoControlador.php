<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}

    public function index(){
    	echo "<h4>Lista de Produtos</h4>";
    	echo "<ul>";
    		echo "<li>Feijao</li>";
    		echo "<li>Caren</li>";
    		echo "<li>Rice</li>";
    		echo "<li>Pano</li>";
    		echo "<li>Feijao</li>";
    	echo "</ul>";
    }

}
