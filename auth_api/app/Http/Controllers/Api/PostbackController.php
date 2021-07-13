<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartaoRequest;

use PagarMe\Client as PagarMe;
use App\Cartao;
use App\Assinatura;
use App\Transacao;

class PostbackController extends Controller
{
  //Tratar postback Pagarme
  public function post_back_pagarme_assinaturas(Request $request){

    $dados = $request->all();

    if ($dados['event'] = 'subscription_status_changed' ) {

        // processing, authorized, paid, refunded, waiting_payment, pending_refund, refused
        $assinatura = Assinatura::where('subscription_id', $dados['subscription']['id'])->first();
        $assinatura->update(['status' => $dados['current_status']]);
        $assinatura->logs()->create([
            'old_status' => $dados['old_status'],
            'current_status' => $dados['current_status'],
            'log' => json_encode($dados)
        ]);

        $response = ['data'=>['success'=>true]];

    }else{

        $response = ['data'=>['message'=>'Não foi possivel localizar a assinatura.']];
        return response($responde,422);

    }
    return response($response, 200);
  }

  public function post_back_pagarme_transacions(Request $request){

    $dados = $request->all();

    if ($dados['event'] = 'transaction_status_changed' ) {

        $status = [
            'processing' => 1,
            'authorized' => 2,
            'paid' => 3,
            'refunded' => 4,
            'waiting_payment' => 5,
            'pending_refund' => 6,
            'refused' => 7,
            'chargedback'=>8,
            'analyzing'=>9,
            'pending_review'=>10,
        ];

        $transacao = Transacao::where('pagarme_transaction_id', $dados['transaction']['id'])->first();
        $transacao->update(['status' => $status[$dados['current_status']]]);

        $transacao->logs()->create([
            'old_status' => $status[$dados['old_status']],
            'current_status' => $status[$dados['current_status']],
            'log' => json_encode($dados)
        ]);

        $response = ['data'=>['success'=>true]];

    }else{

        $response = ['data'=>['message'=>'Não foi possivel localizar a transacao.']];
        return response($responde,422);

    }

    return response($response, 200);
  }

}
