<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Departamento extends Controller
{
    public function index(){
    	echo "<h4>Lista de CATEGORIAS</h4>";
    	echo "<ul>";
    	echo "<li>INFO</li>";
    	echo "<li>Móveis</li>";
    	echo "<li>Asses</li>";
    	echo "<li>Newwers</li>";
    	echo "</ul>";
    	echo "<hr>";
    	if(Auth::check()){
    		$user = Auth::user();
    		echo "<h4>Voce esta logado</h4>";
    		echo "<h5>".$user->name."</h5>";
    		echo "<h5>".$user->email."</h5>";
    		echo "<h5>".$user->id."</h5>";
    	}else{	
    		echo "<h4>Voce não esta logado</h4>";
    	}
    }
}
