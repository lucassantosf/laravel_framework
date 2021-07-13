<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RespostaRequest;
use Illuminate\Http\Request;

use App\Resposta;
use App\Pergunta;

class RespostasController extends Controller
{
    //Salvar post de resposta - exclusivo para perfil médico
    public function post_resposta(RespostaRequest $request){

    	$new = $request->all();

        $user = $request->user();

        if ($user->role_id != 3) {

            $response = ['message'=> 'The given data was invalid.','tipo' => 'Função apenas para médicos'];

            return response($response, 422);

        } else {

            $new['user_id'] = $user->id;

            $pergunta = Pergunta::where('status',0)->where('id',$new['pergunta_id'])->first();

        	if(!empty($pergunta)){

                $resposta = Resposta::create($new);

        		$response = ['data' => array(
    		    	'success' => true
    		    )];

        		//Atualizar pergunta para respondida
        		$pergunta->status = 1 ;
        		$pergunta->update();

    		    return response($response, 200);

        	}else{

        		$response = ['data' => array(
    		    	'message' => 'Esta pergunta já foi respondida'
    		    )];

        		return response($response, 422);
        	}
        }

    }

    //Atualizar resposta replica - exclusivo para perfil médico
    public function put_resposta(RespostaRequest $request){

        $data = $request->all();
        $user = $request->user();

        if ($user->role_id != 3) {

            $response = ['message'=> 'The given data was invalid.','tipo' => 'Função apenas para médicos'];
            return response($response, 422);

        } else {

            $resposta = Resposta::where('user_id',$user->id)->where('pergunta_id',$data['pergunta_id'])->where('replica',null)->first();

            if(!empty($resposta)){

                $resposta->update($data);

                $response = ['data' => array(
                  'resposta' => $resposta
                )];

                return response($response, 200);

            }else{

                $response = ['data' => array(
                  'message' => 'Não foi possivel editar a resposta - resposta nao localizada ou ja possui replica'
                )];

                return response($response, 422);
            }


        }

    }
}
