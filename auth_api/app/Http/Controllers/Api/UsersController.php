<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\CadastroRequest;
use App\Http\Requests\EspecialidadesapiRequest;
use App\Http\Requests\UserEspecialidadeRequest;
use App\Http\Requests\EspecialidadeAlterarRequest;
use App\Http\Requests\LoginRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\MedicosEspecialidade;
use App\UserEspecialidade;
use App\Especialidade;
use App\Pergunta;
use App\Resposta;
use App\Pacote;
use App\Transacao;

use Hash;
use Auth;
use File;

class UsersController extends Controller
{
    //Salvar o cadastro de novo usuário
    public function post_register (CadastroRequest $request) {

    	$dados = array(
    		'name' => $request['name'],
    		'email' => $request['email'],
    		'role_id' => $request['tipo'],
    		'username' => $request['documento'],
    		'password' =>bcrypt($request['password']),
    	);

        $user = User::create($dados);

        //Registrar primeira transacao do usuario se role_id = 2
        if($user->role_id == 2){
            $pacote = Pacote::where('id',1)->first();
            $transacao = $user->transacoes()->create([
                'pacote_id'=>$pacote->id,
                'perguntas_remaining'=>$pacote->perguntas,
                'especialidades_quantity'=>$pacote->especialidades,
                'especialidades_changes_remaining'=>$pacote->trocas_especialidade,
                'status'=>2
            ]);
            $transacao->logs()->create([
                'current_status'=>$transacao->status,
                'log'=>json_encode($transacao)
            ]);
        }

	    $token = $user->createToken('Laravel Password Grant Client')->accessToken;

        $response = ['data' => array(
	    	'token' => $token,
	    	'especialidades' => []
	    )];

	    return response($response, 200);
	}

    //Edição do perfil do usuário
    public function put_profile (Request $request){

        $up = $request->all();

        $user = $request->user();

        if(!empty($request->name)){
            $user->name = $request->name;
        }
        if(!empty($request->email)){
            $user->email = $request->email;
        }
        if(!empty($request->fone)){
            $user->fone = $request->fone;
        }
        if(!empty($request->cep)){
            $user->cep = $request->cep;
        }
        if(!empty($request->cidade)){
            $user->cidade = $request->cidade;
        }
        if(!empty($request->estado)){
            $user->estado = $request->estado;
        }
        if(!empty($request->endereco)){
            $user->endereco = $request->endereco;
        }
        if(!empty($request->numero)){
            $user->numero = $request->numero;
        }
        if(!empty($request->complemento)){
            $user->complemento = $request->complemento;
        }
        if(!empty($request->bairro)){
            $user->bairro = $request->bairro;
        }
        if(!empty($request->pais)){
            $user->pais = $request->pais;
        }

        //Decode base64, salvar img, e no banco manter referencia
        if(!empty($request->image)){

            /*define('/home/agenciaweb/public_html/gadapi/uploads/', 'usuarios/');
            if (!is_dir('uploads/usuarios/')) {
                mkdir('upload/usuarios/',0777, true);
            }*/
            $image = $request->image;  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName =  str_random(50).'.'.'png';
            //file_put_contents('uploads/usuarios/'.$imageName, base64_decode($image));
            File::put('uploads/usuarios/'.$imageName, base64_decode($image));
            $user->image = $imageName;
        }

        $user->update();

        return response(array('message'=> 'Dados alterados com sucesso'), 200);
    }

    //Retornar dados o user logado
	public function get_dados(Request $request){

		$user = Auth::user();

        switch ($user->role_id) {
            case 2:
                $temp = $user->userespecialidades()->get();
                break;

            case 3:
                $temp = $user->especialidades()->get();
                break;
            default:
                # code...
                break;
        }

		$especialidades = array();
		foreach($temp as $key => $esp){
			$especialidades[] = $esp->especialidade->descricao;
		}

		$dados = array(
    		'name' => $user->name,
    		'email' => $user->email,
    		'tipo' => $user->role_id,
    		'documento' => str_replace(['cpf_','crm_'], '', $user->username),
    		'especialidades' => $especialidades,
            'image' => $user->image,
            'fone' => $user->fone,
            'cep' => $user->cep,
            'cidade' => $user->cidade,
            'endereco' => $user->endereco,
            'estado' => $user->estado,
            'numero' => $user->numero,
            'complemento' => $user->complemento,
            'bairro' => $user->bairro,
            'pais' => $user->pais
        );

        if($user->role_id == 2){
            $dados['perguntas_realizadas'] = $user->perguntas()->count();
            $dados['perguntas_respondidas'] = $user->perguntas()->where('status',1)->count();
            $dados['perguntas_restantes'] = $user->transacoes()->whereIn('status',[2,3])->get()->sum('perguntas_remaining');
            $dados['trocas_especialidades_restantes'] = $user->transacoes()->whereIn('status',[2,3])->get()->sum('especialidades_changes_remaining');
        }else if($user->role_id==3){
            $dados['perguntas_respondidas'] = $user->respostas()->count();
        }

		$response = ['data' => $dados];

	    return response($response, 200);
	}

    //Função Login
	public function post_login(LoginRequest $request) {

	    $user = User::where('username', $request->username)->where('role_id', $request->tipo)->first();

	    if ($user) {

	        if (Hash::check($request->password, $user->password)) {
	            $token = $user->createToken('Laravel Password Grant Client')->accessToken;

	            $especialidades = array();
	            if ($user->role_id == 3){
	            	$temp = $user->especialidades()->get();

					foreach($temp as $key => $esp){
						$especialidades[] = $esp->especialidade->descricao;
					}
                }

				$dados = array(
		    		'name' => $user->name,
		    		'email' => $user->email,
		    		'tipo' => $user->role_id,
		    		'documento' => str_replace(['cpf_','crm_'], '', $user->username),
                    'especialidades' => $especialidades,
		    		'token' => $token,
		    	);

	            $response = ['data' => $dados];
	            return response($response, 200);
	        }

	    }

        return response(
        	array(
        		'message'=> 'The given data was invalid.',
        		'errors' => ['username' => 'Usuário ou senha inválidos']
        	), 422);
	}

    //Função logout
	public function get_logout (Request $request) {

	    $token = $request->user()->token();
	    $token->revoke();

	   	$response = ['data' => array(
	    	'message'=> 'Logout realizado com sucesso',
	    )];

	    return response($response, 200);
	}

    //Recuperar especialidades selecionadas pelo user com assinatura ou plano gratuito
    public function get_especialidades(Request $request){

        $user = $request->user();

        switch ($user->role_id) {
            case 2:

                $especialidades = array();
                $especialidades_outras = array();
                $especialidades_id = array();
                $esps = $user->userespecialidades()->get();

                if(!empty($esps)){
                    foreach($esps as $key => $esp){
                        $especialidades[] = $esp->especialidade;
                        $especialidades_id[] = $esp->especialidade->id;
                    }
                }

                //Outras Especialidades
                $esps = Especialidade::whereNotIn('id',$especialidades_id)->get();

                foreach($esps as $key => $esp){
                    $especialidades_outras[] = $esp;
                }

                //Array Dados
                $dados = array(
                    'especialidades' => $especialidades,
                    'outras' => $especialidades_outras
                );

                $response = ['data' => $dados];

                break;

            case 3:

                $dados = array(
                    'especialidades' => $user->especialidades()->get(),
                );

                $response = ['data' => $dados];

                break;

            default:

                $dados = array(
                    'especialidades' => [],
                );

                $response = ['data' => $dados];

                break;
        }

        return response($response, 200);
    }

    //Função para atualizar especialidades do user medico
	public function put_especialidades(EspecialidadesapiRequest $request){

    	$up = $request->all();
    	$user = $request->user();

    	if ($user->role_id != 3) {

    		return response(
        	array(
        		'message'=> 'The given data was invalid.',
        		'errors' => ['tipo' => 'Função apenas para médicos']
        	), 422);

    	} else {

    		MedicosEspecialidade::where('user_id', $user->id)->delete();

	    	$new = array();
	    	foreach($up['especialidades'] as $key => $especialidade){
	    		$new[]['especialidade_id'] = $especialidade;
	    	}

	    	$status = $user->especialidades()->createMany($new);
	    	$response = ['data' => array(
		    	'status' => $status
		    )];

		    return response($response, 200);
    	}
    }

    //Escolha da especialidade do user - valida se possui assinatura ou não
    public function put_especialidade_usuario(UserEspecialidadeRequest $request){

    	$up = $request->all();
    	$user = $request->user();
        $especialidade = Especialidade::find($up['especialidade_id']);

    	if ($user->role_id != 2) {

    		return response(array(
        		'message'=> 'The given data was invalid.',
        		'errors' => ['tipo' => 'Função apenas para usuários']
        	), 422);

    	}else if(!$especialidade){

            return response(['message'=> 'Especialidade não encontrada'], 422);

        }else{

            $esp = $user->userespecialidades()->where('especialidade_id',$up['especialidade_id'])->first();
            //Verificar se já possui escolhido a especialidade do post
            if(!$esp){

                //Verificar em todas compras - no maior valor encontrado no campo 'especialidades_quantity'
                //se esta quantidade permite um post para mais uma especialidade
                //e comparar com quantas especialidades ja tem selecionadas
                //somente em transacoes com status 2,3
                $max = $user->transacoes()->whereIn('status',[2,3])->max('especialidades_quantity');
                $esps = $user->userespecialidades()->count();

                if($esps < $max){
                    $user->userespecialidades()->create(['especialidade_id'=>$up['especialidade_id']]);
                    $response = ['data' => ['status' => true]];
                }else{
                    $response = ['data' => ['status' => false]];
                }

                return response($response, 200);

            }else{

                return response(['message'=> 'Especialidade já selecionado pelo usuário'], 422);
            }
    	}
    }

    //Contador de perguntas realizadas (user tipo 2)
    public function get_perguntas_realizadas(Request $request){

        $user = $request->user();

        if ($user->role_id != 2) {
            return response(['message'=> 'Função apenas para usuários'], 401);
        }

    	$perguntas = $user->perguntas()->count();

        $response = ['data' => array(
            'realizadas' => $perguntas
        )];

        return response($response, 200);
    }

    //Listagem de perguntas realizadas (user)
    public function get_perguntas_realizadas_list(Request $request){

    	$user = $request->user();

    	$perguntas = Pergunta::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

    	if($perguntas){
    		$response = ['data' => array(
		    	'perguntas' => $perguntas
		    )];

    		return response($response, 200);

    	}else{
    		return response(
	        	array(
	        		'message'=> 'Usuário logado não realizou perguntas.'
	        	), 422);
    	}
    }

    //Contador de perguntas respondidas (user/medico)
    public function get_perguntas_respondidas(Request $request){

    	$user = $request->user();

    	switch ($user->role_id) {
    		case 2:
    			$respondidas = $user->perguntas()->where('status',1)->count();

    			$response = ['data' => array(
			    	'respondidas' => $respondidas
			    )];

	    		return response($response, 200);

    			break;

    		case 3:
    			$respondidas = $user->respostas()->count();

    			$response = ['data' => array(
			    	'respondidas' => $respondidas
			    )];

	    		return response($response, 200);

    			break;
    	}
    }

    //Contador de perguntas restantes (user)
    public function get_perguntas_restantes(Request $request){

        $user = $request->user();

        if ($user->role_id != 2) {

            return response(
            array(
                'message'=> 'The given data was invalid.',
                'errors' => ['tipo' => 'Função apenas para usuários']
            ), 422);

        } else {

            $perguntas_restantes = $user->transacoes()->whereIn('status',[2,3])->get()->sum('perguntas_remaining');

            $response = ['data' => array(
                'restantes' => $perguntas_restantes
            )];

            return response($response, 200);
        }
    }

    //Alterar especialidades selecionadas pelo user, validar de acordo à assinatura
    public function post_especialidade_alterar(EspecialidadeAlterarRequest $request){

        $up = $request->all();
        $user = $request->user();

        //Verificar se possui trocas de especialidades restantes na transacao do post
        $transacao = $user->transacoes()->whereIn('status',[2,3])->first();

        if(empty($transacao)){
            return response(['message'=> 'Transacao não localizada'], 404);
        }else{
            //Pegar todos - foreach - se a quantidade em algum indice for maior que zero cai fora
            $trans = $user->transacoes()->get();
            foreach($trans as $key=>$tran){
                if($tran->especialidades_changes_remaining > 0 && !($tran->status != 2  && $tran->status != 3)){
                    $transacao = $tran;
                    break;
                }
            }
        }

        if($transacao->especialidades_changes_remaining > 0){

            //realizar a troca, criar Especialidadelog, decrescer uma troca na transacao
            $useresp = $user->userespecialidades()->where('especialidade_id',$up['especialidade_id_from'])->first();
            if(!$useresp){
                return response(['message'=> 'Especialidade não encontrada para alterar'], 422);
            }
            $useresp->especialidade_id = $up['especialidade_id_to'];
            $useresp->update();

            $dataLog = [
                'user_id' => $user->id,
                'origem' => 'troca_de_especialidade',
                'especialidade_id_from'=>$up['especialidade_id_from'],
                'especialidade_id_to'=>$up['especialidade_id_to'],
                'transacao_id'=>$transacao->id
            ];
            $user->especialidadeslogs()->create($dataLog);

            $transacao->especialidades_changes_remaining = $transacao->especialidades_changes_remaining - 1;
            $transacao->update();

            $response = ['data' => ['success' => true]];
            return response($response, 200);

        }else{
            return response(['message'=> 'Usuario nao possui transacoes que permitam troca de especialidade'], 422);
        }
    }

    //Contador de escolha de especialidades restantes (user)
    public function get_especialidades_restantes(Request $request){

        $user = $request->user();

        if ($user->role_id != 2) {

            return response(
                array(
                    'message'=> 'The given data was invalid.',
                    'errors' => ['tipo' => 'Função apenas para usuários']
                ), 422);

        }else{

            $trocas = $user->transacoes()->whereIn('status',[2,3])->get()->sum('especialidades_changes_remaining');

            $response = ['data' => array(
                'trocas_especialidades_restantes' => $trocas
            )];

            return response($response, 200);

        }
    }

    //Post confirmar senha
    public function post_password_confirm(Request $request){

        $user = $request->user();

        if (Hash::check($request->password, $user->password)) {
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
