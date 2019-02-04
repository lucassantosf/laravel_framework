<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modalidade;
use App\Plano;

class PlanoController extends Controller
{
    public function indexPlans(){
        $plans = Plano::all();
        $duracoes = DB::table('duracoes_planos')->get();
        
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
        $duracoes = DB::table('duracoes_planos')->where('plano_id',$plan->id)->get();
        $modals = Modalidade::all();
        $mt = DB::table('modalidades_planos')->where('plano_id',$plan->id)->get();       
        $i=2;        
        return view('cadastros.formPlan',compact('plan','i','duracoes','modals','mt'));
    }

    public function postformPlanEdit(Request $request, $id){
        $plan = Plano::find($id); 
        
        if(isset($plan)){
            $plan->name = $request->input('name');
            $plan->status = $request->input('status') == 'A' ? true : false;
            $plan->save();
            $duracoes_post = $request->input('duracao');

            //foreach para inserir novas duracoes vindas do post
            foreach ($duracoes_post as $dp) {
                $this->hasDurationInDatabase($plan->id,$dp);
            }
            //foreach para remover duracoes que não vieram no post
            $this->hasDurationInPost($duracoes_post, $plan);

        }
        return redirect('/cadastros/plans');
        exit();  
        
        $d = $request->input('modals');
        var_dump($d);
        exit();
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

    public function destroyPlan($id){
        $plan = Plano::find($id);
        if($plan){
            $plan->delete();
        }
        return redirect('/cadastros/plans');
    }


}
