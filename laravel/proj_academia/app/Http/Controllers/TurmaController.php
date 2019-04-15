<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TurmaController extends Controller
{	
	//Retornar apenas a view com listagem das turmas
    public function indexTurmas(){
    	$i = 0;
    	return view('cadastros.formTurma',compact('i'));
    }

    //Retornar a view do cadastro da turma com o furmulário
    public function formTurma(){
    	$i = 1;
    	return view('cadastros.formTurma',compact('i'));
    }

    //Tratar o post da Form da Turma
    public function postFormTurma(Request $request){
    	
    }
}
