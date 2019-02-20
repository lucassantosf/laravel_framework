<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cliente;
use App\Plano;
use App\Modalidade;
class ClienteController extends Controller
{
    public function indexClients(){
    	$clients = Cliente::all();
    	return view('cadastros.client',compact('clients'));
    }

    public function indexClientsAdd(){
    	return view('cadastros.formClientAdd');
    }

    public function postClientsAdd(Request $request){

    	//validacao de campos com 'msgs' personalizadas
        $regras = [
            'name'=>'required|min:5|max:150',
            'cpf'=>'required',
            'phone'=>'required',        
            'email'=>'required|email',
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio'
        ];
        $request->validate($regras,$mensagens);
        $cli = new Cliente();
		$cli->name = $request->input('name');
        $cli->dt_born = date('Y/m/d',strtotime($request->input('dt_born')));
        $cli->name_mother = $request->input('name_mother');
        $cli->name_father = $request->input('name_father');
        $cli->sexo = $request->input('sexo');
        $cli->est_civil = $request->input('est_civil');
        $cli->cpf = $request->input('cpf');
        $cli->rg = $request->input('rg');
        $cli->rne = $request->input('rne');
        $cli->phone = $request->input('phone');
        $cli->email = $request->input('email');
        $cli->cep = $request->input('cep');
        $cli->address = $request->input('address');
        $cli->number = $request->input('number');
        $cli->comple = $request->input('comple');
        $cli->neigh = $request->input('neigh');
        $cli->country = $request->input('country');
        $cli->uf = $request->input('uf');
        $cli->city = $request->input('city');
        $cli->save();
        return redirect('/clients');
    }

    public function showClient($id){
    	$client = Cliente::find($id);
    	if(isset($client)){
            $plano = DB::table('vendas')->where('cliente_id',$client->id)->orderBy('id')->get();
    		return view('profile',compact('client','plano'));
    	}
    }

    public function newContract($id){
    	$client = Cliente::find($id);
        $plans = DB::table('planos')->where([
        	['status',1],
        	['deleted_at',NULL],
        ])->get();
        $duracoes = DB::table('duracoes_planos')->get();
        $plan_id = 0;
        $modals = Modalidade::all();
    	return view('novoContrato',compact('client','plans','duracoes','plan_id','modals'));
    }

}
