<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PerguntaRequest;
use App\Http\Requests\FiltroPerguntasRequest;
use App\Http\Requests\AvaliacaoRequest;

use Auth;
use App\Pergunta;
use App\Avaliacao;
use App\Transacao;

class PerguntasController extends Controller
{
  //Recuperar listagem de perguntas - medico
  public function get_lista_medico(Request $request){

  	$user = Auth::user();

    if ($user->role_id != 3) {

      return response(
        array(
          'message'=> 'The given data was invalid.',
          'errors' => ['tipo' => 'Função apenas para médicos']
        ), 422);

    } else {

		  $temp = $user->especialidades()->get();

  		if($temp){
  			foreach ($temp as $key => $value) {
	  			$especialidades_id[] = $value->especialidade_id;
	  		}
  		}

  		$perguntas = Pergunta::where('status',0)->whereIn('especialidade_id',$especialidades_id)->orderBy('created_at','DESC')->get();

    	$response = ['data' => array(
	    	'perguntas' => $perguntas
	    )];

	    return response($response, 200);

    }
  }

  //Tratar post do form pergunta
  public function post_pergunta(PerguntaRequest $request){

    $data = $request->all();
    $user = $request->user();

    //Verificar se o usuario possui a especialidade_id
    $checkEspes = $user->userespecialidades()->where('especialidade_id',$data['especialidade_id'])->first();
    if(empty($checkEspes)){
        return response(['message'=> 'Usuário não possui especialidade selecionada'], 401);
    }

    $transacao = $user->transacoes()->first();
    if(empty($transacao)){
        return response(['message'=> 'Usuário nao possui transações disponíveis'], 401);
    }else{

        //Pegar todos - foreach - se a quantidade em algum indice for maior que zero cai fora
        $trans = $user->transacoes()->get();
        foreach($trans as $key=>$tran){
            if($tran->perguntas_remaining > 0 && !($tran->status != 2  && $tran->status != 3)){
                $transacao = $tran;
                break;
            }
        }
    }

    //Verificar se a transacao nao esta com status  2(authorized) ou 3(paid)
    if($transacao->status != 2 && $transacao->status != 3){
        return response(['message'=> 'Usuário nao possui pacotes que permitem realizar perguntas devido ao status atual: '.$transacao->status], 422);
    }

    //Verificar se a transacao possui saldo de perguntas
    if($transacao->perguntas_remaining === 0){
        return response(['message'=> 'Usuário nao possui pacotes que permitem realizar perguntas'], 401);
    }

    try {
        $data['transacao_id'] = $transacao->id;

        $pergunta = $user->perguntas()->create($data);

        $response = ['data' => array(
            'success' => true,
            'pergunta' => $pergunta
        )];

        $transacao->perguntas_remaining = $transacao->perguntas_remaining - 1;
        $transacao->update();

        $status = 200;

    } catch (\Throwable $th) {
        return response(['message'=> 'Erro ao criar pergunta.'.$th], 422);
    }

    return response($response, $status);

  }

  //Tratar post do form pergunta
  public function put_pergunta(PerguntaRequest $request){

    $data = $request->all();
    $user = $request->user();

    $pergunta = Pergunta::where('user_id',$user->id)->where('replica',null)->where('id',$data['pergunta_id'])->first();

    if(!empty($pergunta)){

      $pergunta->update($data);

      $response = ['data' => array(
        'perguntas' => $pergunta
      )];

      return response($response, 200);

    }else{

      $response = ['data' => array(
        'message' => 'Não foi possivel editar a pergunta'
      )];

      return response($response, 422);
    }

  }

  //Tratar post da avaliacao de uma pergunta - so é possivel avaliar perguntas respondidas
  public function post_pergunta_avaliar(AvaliacaoRequest $request){

    $data = $request->all();
    $user = $request->user();

    //Verificar se esta respondida
    $pergunta = Pergunta::where('id',$data['pergunta_id'])->where('user_id',$user->id)->where('status',1)->first();

    if(!empty($pergunta)){

      //Verificar se ja possui avaliacao criada para esta pergunta
      $check_aval = Avaliacao::where('pergunta_id',$data['pergunta_id'])->first();

      if(empty($check_aval)){

        $data['user_id'] = $user->id;
        $data['medico_id'] = $pergunta->resposta->user_id;
        $avaliacao = Avaliacao::create($data);
        $response = ['data' => array(
          'success' => true
        )];
        $status=200;

      }else{

        $response = ['data' => array(
          'message' => 'Pergunta já avaliada'
        )];
        $status=422;
      }

    }else{

      $response = ['data' => array(
        'message' => 'Não foi possivel realizar a avaliacao, pergunta nao respondida.'
      )];
      $status=422;
    }

    return response($response, $status);
  }

  //Tratar post da avaliacao de uma pergunta
  public function put_pergunta_avaliar(AvaliacaoRequest $request){

    $data = $request->all();
    $user = $request->user();

    //Verificar se esta respondida
    $pergunta = Pergunta::where('id',$data['pergunta_id'])->where('user_id',$user->id)->where('status',1)->first();

    if(!empty($pergunta)){

      //Verificar se ja possui avaliacao criada para esta pergunta
      $check_aval = Avaliacao::where('pergunta_id',$data['pergunta_id'])->first();

      if(!empty($check_aval)){

        $check_aval->update($data);
        $response = ['data' => array(
          'success' => true
        )];
        $status=200;

      }else{

        $response = ['data' => array(
          'message' => 'Pergunta ainda não avaliada'
        )];
        $status=422;
      }

    }else{

      $response = ['data' => array(
        'message' => 'Não foi possivel realizar a avaliacao, pergunta nao respondida.'
      )];
      $status=422;
    }

    return response($response, $status);
  }

  //Filtro de perguntas
  public function post_perguntas_filtro(Request $request){
    $search = $request->all();
    $user = $request->user();
    $perguntas = new Pergunta();

    switch ($user->role_id) {
      case 2:
        if($request->especialidades_id) {
          $perguntas = $perguntas->whereIn('especialidade_id', $search['especialidades_id'] );
        }

        if(!empty($request->busca)) {
            $perguntas = $perguntas->where('texto', 'like', '%'.$request->busca.'%');
        }

        if(!empty($request['status'])) {
          $perguntas = $perguntas->where('status', $search['status'] );
        }

        $perguntas = $perguntas->where('user_id',$user->id)->get();

        break;

      case 3:

        $especialidades = $user->especialidades()->get()->pluck('especialidade_id')->toArray();

        if($request->especialidades_id) {
          $perguntas = $perguntas->whereIn('especialidade_id', $search['especialidades_id'] );
        }else{
          $perguntas = $perguntas->whereIn('especialidade_id', $especialidades );
        }

        if(!empty($request->busca)) {
            $perguntas = $perguntas->where('texto', 'like', '%'.$request->busca.'%');
        }

        if(!empty($request['status'])) {
          $perguntas = $perguntas->where('status', $search['status'] );
          $perguntas = $perguntas->whereIn('especialidade_id',  $especialidades );
        }

        $perguntas = $perguntas->get();

        //Remover perguntas de outro medico caso o filtro for por respondidas
        if(isset($request['status']) && $request['status']==1) {
          if(!empty($perguntas)){
            foreach ($perguntas as $key => $perg) {
              if($perg->resposta->user->id != $user->id){
                unset($perguntas[$key]);
              }
            }
          }
        }

        break;
    }

    $response = ['data' => array(
      'perguntas' => $perguntas
    )];

    return response($response, 200);
  }

  //Recuperar uma pergunta individual
  public function get_pergunta(Request $request, $id){

    $user = $request->user();

    switch ($user->role->id) {

      case 2:

        $pergunta = Pergunta::where('user_id',$user->id)->where('id',$id)->first();

        if($pergunta){

          $pergunta->user = $user;
          $pergunta->especialidade = $pergunta->especialidade->descricao;

          if($pergunta->resposta){

            $resp = $pergunta->resposta;

            $response = ['data' => array(
              'pergunta' => $pergunta,
              'avaliacao' => $pergunta->avaliacao,
              'resposta' => $resp,
              'resposta_user' => $resp->user
            )];

          }else{

            $response = ['data' => array(
              'pergunta' => $pergunta
            )];

          }

          return response($response, 200);

        }else{

          return response(

            array(
              'message'=> 'The given data was invalid.',
              'errors' => ['Pergunta' => 'Dados não encontrados']
            ), 422);

        }
        break;

      case 3:

        $pergunta = Pergunta::where('id',$id)->first();
        $pergunta->user = $pergunta->user;
        $pergunta->especialidade = $pergunta->especialidade->descricao;

        if($pergunta){

          if($pergunta->resposta){

            $resp = $pergunta->resposta;

            $response = ['data' => array(
              'pergunta' => $pergunta,
              'avaliacao' => $pergunta->avaliacao,
              'resposta' => $resp,
              'resposta_user' => $resp->user
            )];

          }else{

            $response = ['data' => array(
              'pergunta' => $pergunta
            )];

          }

          return response($response, 200);

        }else{

          return response(

            array(
              'message'=> 'The given data was invalid.',
              'errors' => ['Pergunta' => 'Dados não encontrados']
            ), 422);

        }

        break;

      default:

        return response(

          array(
            'message'=> 'The given data was invalid.',
            'errors' => ['Pergunta' => 'Dados não encontrados']
          ), 422);

        break;
    }
  }

}
