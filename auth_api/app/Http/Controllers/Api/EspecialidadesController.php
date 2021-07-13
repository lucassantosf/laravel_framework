<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Especialidade;

class EspecialidadesController extends Controller
{
    public function get_lista(Request $request){
    	$especialidades = Especialidade::all();
	    $response = ['data' => array(
	    	'especialidades' => $especialidades
	    )];

	    return response($response, 200);
    }

 	public function get_especialidadesbusca(Request $request, $busca = null){
    	$especialidades = Especialidade::where('descricao', 'like', '%'.$busca.'%')->get();
	    $response = ['data' => array(
	    	'especialidades' => $especialidades
	    )];

	    return response($response, 200);
    }
    
}
