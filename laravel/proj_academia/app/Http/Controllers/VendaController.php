<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function returnView(){
    	return view('operacao.vendas');
    }
}
