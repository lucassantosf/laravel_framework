<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoControlador extends Controller
{
	public function __construct(){
		$this->middleware('auth');//protengendo este controlador com middleware
	}

    public function index(){
    	echo "<h4>Lista de produtos</h4>";
    	echo "<ul>";
    	echo "<li>Mac</li>";
    	echo "<li>Iphone</li>";
    	echo "<li>Kert</li>";
    	echo "<li>Auyyash</li>";
    	echo "</ul>";
    }
}
