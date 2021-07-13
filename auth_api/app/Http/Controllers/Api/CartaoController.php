<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartaoRequest;

use Auth;
use PagarMe\Client as PagarMe;
use App\Cartao;

class CartaoController extends Controller
{
    //Salvar um cartao no Pagar.me e relacionar ao user logado
    public function post_cartao(CartaoRequest $request){

        $new = $request->all();

        $user = $request->user();

    	if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $pagarme = new PagarMe(env('PAGARME_CHAVE_API'));

        $card = $pagarme->cards()->create([
            'holder_name' => $new['holder_name'],
            'number' => $new['number'],
            'expiration_date' => str_replace("/", "", $new['expiration_date']),
            'cvv' => $new['cvv']
        ]);

        if($card){

            //Verifcar se o card_hash esta em base de dados para não inserir novamente
            $verify = Cartao::where('card_hash',$card->id)->first();

            if(!$verify){

                $new['user_id'] = $user->id;
                $new['brand'] = $card->brand;
                $new['card_hash'] = $card->id;
                $new['last_digits'] = $card->last_digits;
                $new['expiration_date'] = str_replace("/", "", $card->expiration_date);

                try{

                    $cartao = Cartao::create($new);
                    $response = ['data' => array(
                        'success' => true
                    )];

                } catch (\Throwable $th){

                    $response = ['data' => array(
                        'success' => false,
                        'message' => 'Erro ao cadastrar cartao, cartao em uso'
                    )];

                }

            }else{

                $response = ['data' => array(
                'success' => false
                )];

            }

        }else{

            $response = ['data' => array(
                'success' => false
            )];

        }
        return response($response, 200);
    }

    //Obs: Não existe edição de cartão de crédito no Pagar.me
    //A edição é feita apenas nos dados do cartao mas mantendo o token no banco da aplicação
    //Caso vier no post dados de numero, sendo novo ou não, apagar em base e salvar novamente no Pagar-me
    public function put_cartao(CartaoRequest $request,$token){

        $user = $request->user();
        if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $cartao = Cartao::where('user_id',$user->id)->where('card_hash',$token)->first();

        if($cartao){
        if(!empty($request->holder_name)){
            $cartao->holder_name = $request->holder_name;
        }
        if(!empty($request->expiration_date)){
            $cartao->expiration_date = $request->expiration_date;
        }
        if(!empty($request->cvv)){
            $cartao->cvv = $request->cvv;
        }
        if(!empty($request->brand)){
            $cartao->brand = $request->brand;
        }
        $cartao->update();

        if(!empty($request->number)){
            $cartao->delete();
            return $this->post_cartao($request);
        }

        $response = ['data' => array(
            'success' => true
        )];

        }else {

        $response = ['data' => array(
            'success' => false
        )];

        }

        return response($response, 200);
    }

    //Listagem de cartões do user logado
    public function get_cartoes_list(Request $request){

        $user = $request->user();
        if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $cartoes = $user->cartoes()->get();

        $carts = [];

        if(count($cartoes)>0){
            foreach ($cartoes as $cartao) {
                $carts[] = $cartao;
            }
        }

        $response = ['data' => array(
            'cartoes' => $carts
        )];

        return response($response, 200);
    }

    //Recuperar cartões do usuario logado por brand
    public function get_cartao_by_bandeira(Request $request, $brand){

        $user = $request->user();
        if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $cartoes = $user->cartoes()->get();

        $carts = [];

        if(count($cartoes)>0){
        foreach ($cartoes as $cartao) {
            if($cartao->brand == $brand){
            $carts[] = $cartao;
            }
        }
        }

        $response = ['data' => array(
        'cartoes' => $carts
        )];

        return response($response, 200);
    }

    //Recuperar cartão do usuario logado por token
    public function get_cartao_by_token(Request $request, $token){

        $user = $request->user();
        if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $cartao = Cartao::where('user_id',$user->id)->where('card_hash',$token)->first();

        if($cartao){

        $response = ['data' => array(
            'cartao' => $cartao
        )];

        }else{

        $response = ['data' => array(
            'success' => false
        )];

        }

        return response($response, 200);
    }

    //Excluir cartão do usuario logado por token
    public function destroy_cartao_by_token(Request $request, $token){

        $user = $request->user();
        if ($user->role_id != 2) {
    		return response(['message'=> 'The given data was invalid.','errors' => ['tipo' => 'Função apenas para usuarios']], 422);
        }

        $cartao = Cartao::where('user_id',$user->id)->where('card_hash',$token)->first();

        if($cartao){

        $cartao->delete();

        $response = ['data' => array(
            'success' => true
        )];

        }else{
        $response = ['data' => array(
            'success' => false
        )];
        }

        return response($response, 200);
    }
}
