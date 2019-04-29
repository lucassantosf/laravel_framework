<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class UsuarioControlador extends Controller
{	

	public function __construct(){
		//chamando o middleware diretamente pelo controlador
		//$this->middleware('primeiro');
	}

    public function index(){
    	Log::debug('UsuarioControlador@index');
    	return '<h3>Lista de usuários</h3>'.
    		'<ul>'.
    			'<li>A1</li>'.
    			'<li>A2</li>'.
    			'<li>A134</li>'.
    			'<li>A4</li>'.
    		'</ul>';
    }

}
