<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modalidade;
use App\Plano;
use App\Venda;
use App\Cliente;
use App\Parcela;
use DateTime;

class PlanoController extends Controller
{
    public $duracao;

    public function indexPlans(){
        //$plans = Plano::withTrashed()->get(); //Traz todos os registros mesmo apagados
        $plans = Plano::all(); //Apagados não trazem
        $duracoes = DB::table('duracoes_planos')->orderBy('duracao')->get();
        
        $modals = Modalidade::all();
        $mp_id = DB::table('modalidades_planos')->get();
        
        $i = 0;
        return view('cadastros.formPlan',compact('plans','i','duracoes','modals','mp_id'));
    }

    public function formPlan(){
        $modals = Modalidade::all();
        $i = 1;
        return view('cadastros.formPlan',compact('modals','i'));
    }  

    public function postFormPlan(Request $request){
    	// Criar o plano e retornar o ID
        $id_plan = DB::table('planos')->insertGetId([
            'name'=>$request->input('name'),
            'status'=>$request->input('status') == 'A' ? true : false,
        ]);
        // Vinculo duracoes_planos        
        $d = $request->input('duracao');
    	for($i = 0; $i < count($d); $i++) {
    		DB::table('duracoes_planos')->insert([
                'plano_id'=>$id_plan,
                'duracao'=>$d[$i],
            ]);            
		} 
        // Vinculo modalidades_planos 
        $m = $request->input('modals');
        for($i = 0; $i < count($m); $i++) {
            DB::table('modalidades_planos')->insert([
                'plano_id'=>$id_plan,
                'modal_id'=>$m[$i],
            ]);    		
		}  
        return redirect('/cadastros/plans'); 	    	
    }

    public function formPlanEdit($id){
        $plan = Plano::find($id);
        $duracoes = DB::table('duracoes_planos')->where('plano_id',$plan->id)->orderBy('duracao')->get();
        $modals = Modalidade::all();
        $mt = DB::table('modalidades_planos')->where('plano_id',$plan->id)->get();       
        $i=2;        
        return view('cadastros.formPlan',compact('plan','i','duracoes','modals','mt'));
    }

    public function postformPlanEdit(Request $request, $id){
        $plan = Plano::find($id); 
        
        if(isset($plan)){           
            $duracoes_post = $request->input('duracao');
            if(isset($duracoes_post)){
                //foreach para inserir novas duracoes vindas do post
                foreach ($duracoes_post as $dp) {
                    $this->hasDurationInDatabase($plan->id,$dp);
                }
                //foreach para remover duracoes que não vieram no post
                $this->hasDurationInPost($duracoes_post, $plan);
            }else{
                $this->deleteAllDurations($plan);
            }

            $modals_post = $request->input('modals');
            if(isset($modals_post)){
                //foreach para inserir novas modals do post
                foreach ($modals_post as $m) {
                    $this->hasModalInDatabase($m, $plan->id);
                }
                $this->hasModalInPost($request->input('modals'),$plan);
            }else{
                $this->deleteAllModals($plan);
            }

            $plan->name = $request->input('name');
            $plan->status = $request->input('status') == 'A' ? true : false;
            $plan->save();

        }
        return redirect('/cadastros/plans');        
    }

    public function hasModalInPost($post, $plan){
        $modals_bd = DB::table('modalidades_planos')->where('plano_id',$plan->id)->get();
        if (isset($modals_bd)) {
            foreach ($modals_bd as $db) {
                if (in_array($db->modal_id, $post)){
                    //echo 'Tem no post modal'.$db->modal_id.'</br>';
                }else{                    
                    DB::table('modalidades_planos')->where([
                        ['plano_id','=',$plan->id],
                        ['modal_id','=',$db->modal_id],                
                    ])->delete();
                }                
            }            
        }
    }

    public function hasModalInDatabase($data, $plano_id){
        $hasModalPlan = DB::table('modalidades_planos')->where([
            ['plano_id','=',$plano_id],
            ['modal_id','=',$data],                
            ])->get();
        if(count($hasModalPlan) > 0){
            //Caiu aqui - modal tem no banco, não precisa fazer nada
        }else{
            //Mandar salvar a nova modal que não tem no banco
            DB::table('modalidades_planos')->insert([
                'plano_id'=>$plano_id,
                'modal_id'=>$data,
            ]);
        }        
    }

    public function deleteAllModals($plan){
        // Deletar todas duracoes do post
        DB::table('modalidades_planos')->where([
            ['plano_id','=',$plan->id],                
        ])->delete();
    }

    public function hasDurationInPost($post, $plan){
        
        $duracoes_bd = DB::table('duracoes_planos')->where('plano_id',$plan->id)->get();

        foreach ($duracoes_bd as $d) {
            if (in_array($d->duracao, $post)){
                // Não precisa fazer nada
            }else{
                // Deletar esta duracao no post
                DB::table('duracoes_planos')->where([
                ['plano_id','=',$plan->id],
                ['duracao','=',$d->duracao],                
                ])->delete();
            }            
        }
    }

    public function hasDurationInDatabase($plano_id,$duracao){

        $hasDurationPlan = DB::table('duracoes_planos')->where([
            ['plano_id','=',$plano_id],
            ['duracao','=',$duracao],                
            ])->get();     

        if(count($hasDurationPlan)>0){
            //Caiu aqui - duracao tem no banco, não precisa fazer nada
        }else{
            //Mandar salvar a nova duracao que não tem no banco
            DB::table('duracoes_planos')->insert([
                'plano_id'=>$plano_id,
                'duracao'=>$duracao,
            ]);
        }
    }

    public function deleteAllDurations($plan){
        // Deletar todas duracoes do post
        DB::table('duracoes_planos')->where([
            ['plano_id','=',$plan->id],                
        ])->delete();
    }

    public function destroyPlan($id){
        $plan = Plano::find($id);
        if($plan){
            try{
                $plan->delete();
            }catch(Exception $e){
                return redirect('/cadastros/plans');
            }
        }
        return redirect('/cadastros/plans');
    }

    public function detailsPlans($id){
        $plan = Plano::find($id);
        $duracoes = [];
        $modals = [];
        $duracoes_bd = DB::table('duracoes_planos')->where('plano_id',$plan->id)->orderBy('duracao')->get();

        foreach ($duracoes_bd as $d) {            
            array_push($duracoes, $d->duracao);
        }
        
        $modals_bd = DB::table('modalidades_planos')->where([
            ['plano_id','=',$plan->id],           
        ])->get();

        foreach ($modals_bd as $m) {  
            $modal = Modalidade::find($m->modal_id);
            array_push($modals, [$modal->name=>$modal->value,'modal_id'=>$m->modal_id]);            
        }

        $dados = array('plano_nome'=>$plan->name,'duracoes'=>$duracoes,'modals'=>$modals);
        return json_encode($dados);
    }

    public function postConferirNeg(Request $request){
        $plano_id = $request->input('selectPlan');
        $cliente_id = $request->input('id_cliente');
        $plano = Plano::find($plano_id);
        $plano_descricao = $plano->name;
        $duracao = $request->input('duracao');
        $value_total = 0;
        foreach ($request->input('modals') as $m_id) {
            $modal = Modalidade::find($m_id);
            $value_total += $modal->value;
        }
        $valor_contrato = $duracao*$value_total;
        return view('operacao.conferirContrato',compact('valor_contrato','plano_descricao','duracao','plano_id','cliente_id'));
    }

    public function postVenda(Request $request){
        $venda = new Venda();
        $venda->cliente_id = $request->input('cliente_id');
        $venda->plano_id = $request->input('plano_id');
        $valor_mensal =  $request->input('valor_final'); 
        $condicao =  $request->input('condicao'); //condicao da negociação
        $duracao =  $request->input('duracao'); //duracao
        $desconto = $request->input('desconto'); //desconto
        if(isset($desconto)){
            $valor_total = ($valor_mensal*$condicao) - $desconto; 
            $venda->value_total = $valor_total;                   
        }else{
            $valor_total = ($valor_mensal*$condicao); 
            $venda->value_total = $valor_total;           
        } 
        $venda->dt_inicio = date('d/m/Y');//data atual
        $venda->dt_fim = date('d/m/Y', strtotime("+".$duracao." months") );//somar a duracao a data atual
        $venda->save();
        //salvar cada parcela no banco
        $cliente = Cliente::find($venda->cliente_id);//procurar o nome do cliente para salvar na parcela
        for($i=0 ; $i<$condicao; $i++){
            $parcela = new Parcela();
            $parcela->venda_id = $venda->id;
            $parcela->nome_cliente = $cliente->name;
            $parcela->cliente_id = $venda->cliente_id;
            $parcela->value = $valor_mensal;
            $parcela->save(); 

        }
        //Tornar aluno ativo
        $cliente->situaçao = 'Ativo';
        $cliente->save();
        $msg = 'Venda realizada com sucesso';
        return view('operacao.conferirContrato',compact('msg'));
    }

}
