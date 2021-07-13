<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Assinatura;
use PagarMe\Client as PagarMe;
use App\User;

class AssinaturasController extends Controller
{
	

	

    //Retornar assinaturas do usuario logado salvos em banco de dados da aplicação
    public function get_user_assinaturas(Request $request){

    	$user = $request->user();

    	$assinaturas = $user->assinaturas()->get();

	    $response = ['data' => array(
	    	'assinaturas' => $assinaturas
	    )];

	    return response($response, 200);
    }

    //Retornar dados de uma assinatura consultando dados no Pagarme
    public function get_assinatura(Request $request,$id){

    	$assinatura = Assinatura::find($id);

    	if($assinatura){

    		$subscription = $this->pagarme->subscriptions()->get([
			  'id' => $assinatura->subscription_id
			]);

			$response = ['data' => array(
		    	'assinatura_api' => $assinatura,
		    	'assinatura_pagarme' => $subscription,
		    )];

	    	return response($response, 200);
    	}else{

    		$response = ['data' => []];

	    	return response($response, 404);
    	}
    }

    //Cancelar uma assinatura no Pagarme e na aplicação
    public function cancel_assinatura(Request $request){

    	$assinatura = Assinatura::find($request->assinatura_api_id);

    	if($assinatura){

    		$assinatura->status = 'canceled';

		    $assinatura->update();

    		$canceledSubscription = $this->pagarme->subscriptions()->cancel([
			  'id' => $assinatura->subscription_id
			]);

    		$response = ['data' => array(
		    	'success' => true
		    )];

		    return response($response, 200);
    	}else{

    		$response = ['data' => []];

	    	return response($response, 404);
    	}
    }

}
