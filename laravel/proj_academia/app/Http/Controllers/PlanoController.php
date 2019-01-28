<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Modalidade;
use App\Plano;

class PlanoController extends Controller
{
    public function indexPlans(){
    	$modals = Modalidade::all();
    	return view('cadastros.formPlan',compact('modals'));
    }  

    public function postFormPlan(Request $request){
    	//Criar o plano e retornar o ID
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


}
