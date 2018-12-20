<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use Illuminate\Support\Facades\Cache;

class ProdutosControlador extends Controller
{
    function index(){
    	
    	$expiracao = 1;
    	$produtos = Cache::remember('todosprodutos',$expiracao, function(){
    			return Produto::with('categorias')->get();
    	});   	 

    	return view('produtos',compact(['produtos']));
    }
}
