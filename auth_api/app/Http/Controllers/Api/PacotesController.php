<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PacoteCompraRequest;
use App\Http\Requests\PacoteCancelRequest;
use App\Pacote;
use App\Transacao;
use PagarMe\Client as PagarMe;

class PacotesController extends Controller
{
    private $pagarme;

	public function __construct(){

        $this->pagarme = new PagarMe(env('PAGARME_CHAVE_API'));
        $this->global_status_transactions_pagarme = [
            'processing'=>1,
            'authorized'=>2,
            'paid'=>3,
            'refunded'=>4,
            'waiting_payment'=>5,
            'pending_refund'=>6,
            'refused'=>7,
            'chargedback'=>8,
            'analyzing'=>9,
            'pending_review'=>10,
        ];
    }

    //Recuperar listagem de pacotes, obs: id 1 pacote inicial não retorna na listagem de planos para assinar
    public function get_lista(Request $request){

        $pacotes = Pacote::wherenotIn('id',[1])->where('status',1)->orderBy('valor','ASC')->get();

        $response = ['data' => array(
            'pacotes' => $pacotes
        )];

      	return response($response, 200);
    }

    //Recuperar dados de um plano
    public function get_plano_dados(Request $request,$id){

    	$pacote = Pacote::find($id);

    	if($pacote){

    		$response = ['data' => array(
            	'pacote' => $pacote
        	)];

      		return response($response, 200);

    	}else{

    		$response = ['data' => []];

      		return response($response, 404);
    	}

    }

    //Tratar o post de uma assinatura de recorrencia
    public function post_pacote_compra(PacoteCompraRequest $request){

        $user = $request->user();
        $req = $request->all();

    	$document = explode("cpf_", $user->username);
        $fone =  str_replace("(", "", $user->fone);
        $fone =  str_replace(")", "", $fone);
        $fone =  str_replace("-", "", $fone);
        $cep =  str_replace("-", "", $user->cep);

        $pacote = Pacote::where('id',$req['pacote_id'])->first();

        if(empty($pacote)){
            return response(['message'=> 'Pacote não localizado para realizar compra'], 422);
        }

        /* Validar cartao vinculado ao user */
        $cartao = $user->cartoes()->where('card_hash',$req['card_hash'])->first();
        if(empty($cartao)){
            return response(['message'=> 'Cartão de Crédito não vinculado ou não localizado com o usuario'], 422);
        }

        /* Validar dados obrigatorios do usuario para o Pagarme */
        if(empty($user->name)
            || empty($user->endereco)
            || empty($user->numero)
            || empty($user->cidade)
            || empty($user->bairro)
            || empty($cep)
            || empty($fone)
            || empty($user->estado)){
            return response(['message'=> 'Perfil incompleto para realizar transação. Edite seu perfil e tente novamente'], 500);
        }

        //Criar transacao no Pagarme
        //dd($pacote->valor * 100);
        try {
            $transaction = $this->pagarme->transactions()->create([
                'amount' => ($pacote->valor * 100),
                'payment_method' => 'credit_card',
                'card_id' => $req['card_hash'],
                'postback_url' => route('api.retorno.postback'),
                'customer' => [
                    'external_id'=>(string)$user->id,
                    'email' => $user->email,
                    'name' => $user->name,
                    'documents' => [
                        [
                          'type' => 'cpf',
                          'number' => $document[1]
                        ]
                    ],
                    'phone_numbers' => [ '+'.$fone ],
                    'country'=>'br',
                    'type'=>'individual',
                ],
                'billing' => [
                    'name' => $user->name,
                    'address' => [
                        'country' => 'br',
                        'street' => $user->endereco,
                        'street_number' => $user->numero,
                        'state' => $user->estado,
                        'city' => $user->cidade,
                        'neighborhood' => $user->bairro,
                        'zipcode' => $cep
                    ]
                ],
                'items' => [
                    [
                      'id' => (string)$pacote->id,
                      'title' => $pacote->descricao,
                      'unit_price' => ($pacote->valor * 100),
                      'quantity' => 1,
                      'tangible' => true
                    ],
                ]
            ]);

        } catch (\Throwable $th) {
            return response(['message'=> 'Erro ao criar transacao no Pagarme - serviço indisponível'], 500);
            /*$transaction = new \stdClass();
            $transaction->id = 8675718;
            $transaction->status = 2;*/
        }

		$data['user_id'] = $user->id;
		$data['pagarme_transaction_id'] = $transaction->id;
		$data['pacote_id'] = $pacote->id;
		$data['perguntas_remaining'] = $pacote->perguntas;
		$data['especialidades_quantity'] = $pacote->especialidades;
        $data['especialidades_changes_remaining'] = $pacote->trocas_especialidade;
        $data['pagarme_object_json'] = json_encode($transaction);

		$data['status'] = $this->global_status_transactions_pagarme[$transaction->status];

		$trans = Transacao::create($data);
        $trans->logs()->create([
            'current_status' => $this->global_status_transactions_pagarme[$transaction->status],
            'log' => json_encode($transaction)
        ]);

	    $response = ['data' => array(
	    	'success' => true
	    )];

	    return response($response, 200);
    }

    //Recuperar historico de todas compras do usuario
    public function get_user_pacotes(Request $request){

        $user = $request->user();

        $response = ['data' => array(
            'pacotes' => $user->transacoes()->orderby('id','DESC')->get()
        )];

      	return response($response, 200);
    }

    //Retornar dados de uma assinatura consultando dados no Pagarme
    public function get_user_pacote(Request $request,$id){

        $user = $request->user();
        $transacao = $user->transacoes()->where('id',$id)->first();

    	if($transacao){

    		$transaction = $this->pagarme->transactions()->get([
                'id' => $transacao->pagarme_transaction_id
            ]);

            $transacao->pagarme_info = $transaction;

			$response = ['data' => array(
		    	'pacote' => $transacao
		    )];

	    	return response($response, 200);
    	}else{

    		return response(['message'=> 'Pacote nao localizado - indisponível'], 404);
    	}
    }

    //Cancelar um pacote apenas quando
    public function cancel_pacote(PacoteCancelRequest $request){

        $user = $request->user();
        $req = $request->all();
        $transacao = $user->transacoes()->where('id',$req['pacote_id'])->first();

        if($transacao){

            //validar quantas perguntas esta transacao possui
            //somente cancelar/estornar se nao tiver perguntas vinculadas

            $perguntasCount = $transacao->perguntas()->count();

            if($perguntasCount>0){
    		    return response(['message'=> 'Este pacote possui perguntas realizadas, não é possível estorno'], 422);
            }

    		try {
                $transaction = $this->pagarme->transactions()->refund([
                    'id' => $transacao->pagarme_transaction_id
                ]);
            } catch (\Throwable $th) {
                return response(['message'=> 'Erro ao estornar pacote no Pagarme'], 422);
            }

            //status 4-refund
            $transacao->status = 4;
            $transacao->update();

			$response = ['data' => array(
		    	'pacote' => $transacao
		    )];

	    	return response($response, 200);

        }else{

    		return response(['message'=> 'Pacote nao localizado - indisponível'], 404);
    	}
    }
}
