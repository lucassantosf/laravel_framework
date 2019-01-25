<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modalidade;

class PlanoController extends Controller
{
    public function indexPlans(){
    	$modals = Modalidade::all();
    	return view('cadastros.formPlan',compact('modals'));
    }  

    public function postFormPlan(Request $request){
    	var_dump($request->input('lista1'));
    	exit();
    }
}
