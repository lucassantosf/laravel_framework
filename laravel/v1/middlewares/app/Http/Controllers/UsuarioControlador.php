<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class UsuarioControlador extends Controller
{
	public function __construct(){
		//$this->middleware('primeiro');
	}

    public function index(){
        Log::debug('UsuarioControlador@index');
    	return '<h3>Lista de usuários</h3>'.
    		'<ul>'.
    			'<li>A</li>'.
    			'<li>B</li>'.
    			'<li>C</li>'.
    			'<li>D</li>'.
    		'</ul>';
    }

}
