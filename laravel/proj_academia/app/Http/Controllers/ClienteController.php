<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function indexClients(){
    	return view('cadastros.client');
    }

    public function indexClientsAdd(){
    	return view('cadastros.formClientAdd');
    }

    public function postClientsAdd(Request $request){

    	//validacao de campos com 'msgs' personalizadas
        $regras = [
            'name'=>'required|min:5|max:150',
            'cpf'=>'required',
            'phone'=>'required|max:3',        
            'email'=>'required|email',
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio'
        ];
        $request->validate($regras,$mensagens);

    	echo $request->input('name').'<br>';
    	echo $request->input('dtNasc').'<br>';
    	echo $request->input('nomeMae').'<br>';
    	echo $request->input('nomePai').'<br>';
    	echo $request->input('sexo').'<br>';
    	echo $request->input('estado_civil').'<br>';
    	echo $request->input('cpf').'<br>';
    	echo $request->input('rg').'<br>';
    	echo $request->input('rne').'<br>';
    	echo $request->input('phone').'<br>';
    	echo $request->input('email').'<br>';
    	echo $request->input('cep').'<br>';
    	echo $request->input('address').'<br>';
    	echo $request->input('number').'<br>';
    	echo $request->input('compl').'<br>';
    	echo $request->input('neigh').'<br>';
    	echo $request->input('country').'<br>';
    	echo $request->input('state').'<br>';
    	echo $request->input('city').'<br>';
    	exit();
    }

}
