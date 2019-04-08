<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Cliente;
use App\Plano;
use App\Modalidade;
use App\Venda;
use App\Produto;
use App\Recibo;

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

    public function postClientsEdit(Request $request){
        $cli = Cliente::find($request->input('id'));        
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
        return redirect('/clients/'.$cli->id.'/show');
    }

    public function showClient($id){

    	$client = Cliente::find($id);
    	if(isset($client)){
            $isAtivo = false;
            //Verifica se o aluno possui plano
            $planoC = DB::table('vendas')->where([
                ['cliente_id',$client->id],
                ['deleted_at',NULL]
            ])->first();

            //Se aluno possuir plano - consultar suas parcelas e detalhes deste plano
            if ($planoC) {
                $isAtivo = true;
                $plano_details = DB::table('planos')->where('id',$planoC->plano_id)->first();
                $parcelas = DB::table('parcelas')->where('venda_id',$planoC->id)->get(); 
            }

            //Consultar Recibos do cliente
            $recibos = DB::table('recibos')->where([
                ['cliente_id',$client->id],
                ['deleted_at',NULL]
            ])->get();

            //Consultar Histórico de Compras de Vendas Avulsas
            $compras = DB::table('venda_avulsas')->where([
                ['cliente_id',$client->id],
                ['deleted_at',NULL]
            ])->get();

            $nomesprods = [];

            if(count($compras) > 0){
                //Para cada venda avulsa, consultar tabela itens venda avulsas
                foreach ($compras as $c) {
                    // $c->id é id de cada compra
                    $itens = DB::table('item_venda_avulsas')->where([
                        ['venda_avulsa_id',$c->id],
                        ['deleted_at',NULL]
                    ])->get();   
                    foreach ($itens as $i) {
                        //Adicionar no array nome_produtos_comprados o nome de cada vendido
                        array_push($nomesprods, $i->descricao_produto);
                    }
                }
            } 

            //Consultar parcelas de vendas avulsas
            $parcelas_vendas_avulsas = DB::table('parcela_venda_avulsas')->where('cliente_id',$client->id)->get();
            //var_dump($parcelas_vendas_avulsas);
            //exit();
            
            return view('operacao.profile',compact('client','isAtivo','plano_details','planoC','parcelas','recibos','nomesprods','parcelas_vendas_avulsas'));
    	}else{
            echo 'Cliente inexistente';
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
    	return view('operacao.novoContrato',compact('client','plans','duracoes','plan_id','modals'));
    }

    public function estornarContract($venda_id,$cliente_id){
        $venda = Venda::find($venda_id);
        if($venda){
            try{
                //Tornar aluno visitante
                $cliente = Cliente::find($cliente_id);
                $cliente->situaçao = 'Visitante'; 
                $cliente->save();
                $venda->delete();
                //Estornar os recibos vinculados à venda
                $recibos = DB::table('recibos')->where('venda_id', $venda->id)->get();                 
                foreach ($recibos as $r) {
                    $recibo = Recibo::find($r->id);
                    if(isset($recibo)){
                        $recibo->delete();

                        //Verificação para saber se dentro do recibo possui uma parcela VA - se possuir torna-la em aberto

                        $ir = DB::table('item_recibos')->where('recibo_id', $r->id)->get();
                        foreach ($ir as $i) {
                            $isVA = DB::table('parcela_venda_avulsas')->where([
                                ['id', $i->parcela_id],
                                ['cliente_id',$cliente_id],
                            ])->get();
                            if(count($isVA)>0) {
                                foreach ($isVA as $VA) {
                                    DB::table('parcela_venda_avulsas')
                                    ->where('id', $VA->id)
                                    ->update(['status' => 'Em aberto']);
                                }
                            }
                        }

                    } 
                }
                /*
                $recibos = DB::table('recibos')->where('venda_id', '3')->get();                 
                foreach ($recibos as $r) {
                    $recibo = Recibo::find($r->id);
                    echo $r->id.'<br>';
                    $ir = DB::table('item_recibos')->where('recibo_id', $r->id)->get();
                    foreach ($ir as $i) {
                        echo 'Parcela paga deste recibo'.$i->parcela_id.'<br>';
                        $isVA = DB::table('parcela_venda_avulsas')->where([
                            ['id', $i->parcela_id],
                            ['cliente_id','3'],
                        ])->get();
                        if(count($isVA)>0) echo 'Parcela Venda Avulsa';
                    }
                }*/


            }catch(Exception $e){
                return redirect('/cadastros/plans');
            }

        }
        return redirect('/clients');
    }
}
