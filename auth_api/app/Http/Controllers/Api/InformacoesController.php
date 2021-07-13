<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Info;

class InformacoesController extends Controller
{
    public function get_termosdeuso(Request $request){
    	$termos = Info::first()->termos;
	    $response = ['data' => array(
	    	'termos' => $termos
	    )];

	    return response($response, 200);
    }
}
