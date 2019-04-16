<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Turma;
use App\ItemTurma;
use App\Modalidade;

class TurmaController extends Controller
{	
	//Retornar apenas a view com listagem das turmas
    public function indexTurmas(){
    	$i = 0;
    	$turmas = Turma::all();
    	$modalidades = Modalidade::all();
    	return view('cadastros.formTurma',compact('i','turmas','modalidades'));
    }

    //Retornar a view do cadastro da turma com o furmulário
    public function formTurma(){
    	$i = 1;
    	$modalidades = DB::table('modalidades')->where([
                ['controlTurma',1],
                ['deleted_at',NULL],
        ])->get();
    	return view('cadastros.formTurma',compact('i','modalidades'));
    }

    //Tratar o post da Form da Turma
    public function postFormTurma(Request $request){ 
    	$turma = new Turma();
    	$turma->name = $request->input('descricao_turma'); 
    	$turma->modal_id = $request->input('modal_id');
    	$turma->status = $request->input('status') == 'A' ? true : false;
    	$turma->save(); 
    	$horariosInicio = $request->input('horarioInicio');
    	$horariosFim = $request->input('horarioFim');
    	$qtdTurma = $request->input('qtdTurma');
    	$diaSemana = $request->input('diaSemana'); 
    	for($i = 0 ; $i < count($horariosInicio) ; $i++){
    		$ItemTurma = new ItemTurma();
    		$ItemTurma->hora_inicio = $horariosInicio[$i];
    		$ItemTurma->hora_fim = $horariosFim[$i];
    		$ItemTurma->capacidade = $qtdTurma[$i];
    		$ItemTurma->dia_semana  = $diaSemana[$i]; 
    		$ItemTurma->turma_id = $turma->id;
    		$ItemTurma->save();
    	}
    	return redirect('/cadastros/turmas');
    }

    //ste método exibe os dados de uma turma em especifico, apenas utilizado para quando a turma for editada
    public function formTurmaEdit($id){
    	$i = 2;
    	$turma = Turma::find($id);
    	$modalidades = Modalidade::all();
    	$itens_turma = DB::table('item_turmas')->where([
                ['turma_id',$turma->id],
                ['deleted_at',NULL],
        ])->get();
    	return view('cadastros.formTurma',compact('i','turma','modalidades','itens_turma'));
    }

    //Tratar o post do formulário de edição da turma
    public function postformTurmaEdit(Request $request, $id){
    	$turma = Turma::find($id);
    	if (isset($turma)) {
    		$turma->name = $request->input('descricao_turma'); 
	    	$turma->modal_id = $request->input('modal_id');
	    	$turma->status = $request->input('status') == 'A' ? true : false;
	    	$turma->save();

	    	$item_id = $request->input('item_id');
	    	$horariosInicio = $request->input('horarioInicio');
    		$horariosFim = $request->input('horarioFim');
    		$qtdTurma = $request->input('qtdTurma');
    		$diaSemana = $request->input('diaSemana'); 

	    	var_dump($item_id);
	    	
	    	echo '<br>';

	    	var_dump($horariosInicio);

	    	echo '<br>';
	    	
    		if (isset($item_id)) {
    			for($i = 0 ; $i < count($item_id) ; $i++){
	    			var_dump($item_id);
	    			echo '<br>';
	    		}
    		}else{
    			DB::table('item_turmas')->where([
                	['turma_id',$turma->id],
                	['deleted_at',NULL],
        		])->get();
    		} 

	    	exit(); 
    	}
    	return redirect("/cadastros/turmas");
    }

    //Método para tratar a exclusão da turma, mas há softdeletes
    public function destroyTurma($id){
    	$turma = Turma::find($id);
        if($turma){
            try{
                $turma->delete();
            }catch(Exception $e){
                return redirect('/cadastros/turmas');
            }
        }
        return redirect('/cadastros/turmas');
    } 

}	