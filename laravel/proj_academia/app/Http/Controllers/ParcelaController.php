<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Parcela;
use App\Cliente;
use App\Recibo;
use App\ItemRecibo;

class ParcelaController extends Controller
{
    public function showParcelasVenda($id){
        $parcelas = DB::table('parcelas')->where('venda_id',$id)->get();
        return json_encode($parcelas);
    }

    public function mostrarParcelas(){
        $parcelas = DB::table('parcelas')->where('status','Em aberto')->get();
        //foreach ($parcelas as $p) {
        //	echo 'id '.$p->id.' venda_id '.$p->venda_id.' value '.$p->value.' status '.$p->status.'<br>';
        //}
        //exit();
    	return view('operacao.emAbertoPrincipal',compact('parcelas'));
    }

    public function parcelasEmAberto($id){
    	$cliente = Cliente::find($id);
    	if (isset($cliente)) {
        	$hasVenda = DB::table('vendas')->where('cliente_id',$cliente->id)->first();        	
        	if (isset($hasVenda)) {        		
        		$parcelas = DB::table('parcelas')->where([
        			['status','Em aberto'],
        			['venda_id',$hasVenda->id]
        		])->get();  
        	} 
    	}
    	return view('operacao.emAberto',compact('cliente','parcelas'));
    }

    public function payParcela($id){
    	$parcela = Parcela::find($id);
    	if (isset($parcela)) {
    		$parcela->status = 'Pago';
    		$parcela->save();
    	}
    }

    public function estornarParcela($id){
    	$parcela = Parcela::find($id);
    	if (isset($parcela)) {
    		$parcela->status = 'Em aberto';
    		$parcela->save();
    	}
    }

    public function pagarParcelas(Request $request){
    	$cliente_id = $request->input("client_id");
        $parcelas =	$request->input("parcela");
        $valorTotal = $request->input("valorTotal");
    	return view('operacao.formaPagamentoCaixaAberto',compact('cliente_id','parcelas','valorTotal'));
    }

    public function postCaixaAberto(Request $request){
        //Trabalha o post do caixa em aberto apos selecionar a forma de pagamento
        //gera primeiro o recibo e salva
        $recibo = new Recibo();
        $recibo->cliente_id = $request->input("cliente_id");
        $recibo->formaPagamento = $request->input("formaPagamento");
        $recibo->valorRecibo = $request->input("valorTotal");
        $recibo->save();
        //com o recibo salvo trabalhar em cada parcela para gerar os itens do recibo
        $parcelas = $request->input("parcela");
        foreach($parcelas as $p){
            $itemRecibo = new ItemRecibo();            
            //alterar status da parcela
            $parcela = Parcela::find($p);
            $parcela->status = 'Pago';
            $parcela->save();
            //Gerar os itens do recibo
            $itemRecibo->recibo_id = $recibo->id;
            $itemRecibo->parcela_id = $p;
            $itemRecibo->value = $parcela->value;
            $itemRecibo->save();
        }
        return redirect('/clients/'.$recibo->cliente_id.'/show');
    }

    public function buscarParcelasAberto($nome){
        $parcelas = DB::table('parcelas')->where('nome_cliente','like','%'.$nome.'%')->get();
        return json_encode($parcelas);
    }

}
