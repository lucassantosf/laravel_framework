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
        // Cast to an array(array) 
        $duracoes_bd = (array)DB::table('duracoes_planos')->where('plano_id',$plan->id)->get();
        $this->duracoes_post = $request->input('duracao');

        //foreach para inserir novas duracoes vindas do post
        foreach ($duracoes_post as $dp) {
            $this->hasDurationInDatabase($plan->id,$dp);
        }

        //foreach para remover duracoes que não vieram no post
        foreach ($duracoes_bd as $db) {
            $this->hasDurationInPost($db);
        }

        exit();  
        
        $d = $request->input('modals');
        var_dump($d);
        exit();
    }

    /* Vários Where
    $query->where([
        ['column_1', '=', 'value_1'],
        ['column_2', '<>', 'value_2'],
        [COLUMN, OPERATOR, VALUE],
    ])
    */

    public function hasDurationInPost($post, $duracao){
        var_dump($this->duracoes_post);
        echo '<br>';

        var_dump($duracao);
        echo '<br>';
        //foreach ($post as $p) {
         //   if($duracao->duracao != $p){
         //       echo $duracao.' = '.$p.'<br>';
         //   }
       // }
    }

    public function hasDurationInDatabase($plano_id,$duracao){

        $hasDurationPlan = DB::table('duracoes_planos')->where([
            ['plano_id','=',$plano_id],
            ['duracao','=',$duracao],                
            ])->get();     

        if(count($hasDurationPlan)>0){
            echo 'Tem duracao '.$duracao.'<br>'; //Caiu aqui - duracao tem no banco, não precisa fazer nada
        }else{
            echo "Não tem a duracao".$duracao.'<br>';//Mandar salvar a nova duracao que não tem no banco
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
