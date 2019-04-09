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
    	return view('operacao.emAbertoPrincipal',compact('parcelas'));
    }

    //Esta função é utilizada na tela Caixa em Aberto quando tem o cliente individual, mostra todas parcelas em aberto
    public function parcelasEmAberto($id){
    	$cliente = Cliente::find($id);
    	if (isset($cliente)) {
    		$parcelas = DB::table('parcelas')->where([
    			['status','Em aberto'],
                ['cliente_id',$id],
                ['deleted_at',NULL],
    		])->get(); 

    	}
    	return view('operacao.emAberto',compact('cliente','parcelas'));
    }

    public function getRecibo($parcela_id){
        $parcela = DB::table('item_recibos')->where([
            ['parcela_id',$parcela_id],
        ])->get();
        foreach ($parcela as $p) {
            $recibo = Recibo::find($p->recibo_id);
        }
        return json_encode($recibo);
    }

    //Esta função paga uma parcela individualmente e gera um recibo em dinheiro
    public function payParcela($id){
    	$parcela = Parcela::find($id);
    	if (isset($parcela)) {
    		$parcela->status = 'Pago';
    		$parcela->save();            
    	}
        //Gerar o recibo - obs:venda_id->table recibo é null
        $recibo = new Recibo();
        $recibo->cliente_id = $parcela->cliente_id;
        $recibo->formaPagamento = 'dinheiro';
        $recibo->valorRecibo = $parcela->value;
        $recibo->save();
        //Gerar o item do recibo
        $itemRecibo = new ItemRecibo();
        $itemRecibo->recibo_id = $recibo->id;
        $itemRecibo->parcela_id = $parcela->id;
        $itemRecibo->value = $parcela->value;
        $itemRecibo->save();
    } 
    
    public function pagarParcelas(Request $request){
    	$cliente_id = $request->input("cliente_id");        
        $parcelas =	$request->input("parcela");
        $valorTotal = $request->input("valorTotal");        
    	return view('operacao.formaPagamentoCaixaAberto',compact('cliente_id','parcelas','valorTotal'));
    }

    //Esta função trata o post do caixa em aberto, salva o recibo e altera status da parcela
    public function postCaixaAberto(Request $request){
        //Trabalha o post do caixa em aberto apos selecionar a forma de pagamento
        //gera primeiro o recibo e salva 
        $recibo = new Recibo();
        $recibo->cliente_id = $request->input("cliente_id");
        $recibo->formaPagamento = $request->input("formaPagamento");
        $recibo->valorRecibo = $request->input("valorTotal");

        $lastVenda = DB::table('vendas')->where([
            ['cliente_id',$recibo->cliente_id],
            ['deleted_at',NULL],
            ])->latest()->first();

        if($lastVenda) $recibo->venda_id = $lastVenda->id;;
        
        $recibo->save();

        //com o recibo salvo trabalhar em cada parcela para gerar os itens do recibo
        $parcelas = $request->input("parcela");
        
        foreach($parcelas as $p){
            $itemRecibo = new ItemRecibo();            
            //alterar status da parcela
            //Verificar se é parcela normal ou parcela VA
            $a = DB::table('parcelas')->where([
                ['id',$p],
                ['cliente_id',$request->input("cliente_id")],
            ])->get();
            
            if(count($a) != 0){
                //Se parcela normal
                DB::table('parcelas')
                    ->where('id', $p)
                    ->update(['status' => 'Pago']);
                $parcela = Parcela::find($p);
            } 
            //Gerar os itens do recibo
            $itemRecibo->recibo_id = $recibo->id;
            $itemRecibo->parcela_id = $p;
            $itemRecibo->value = $parcela->value;
            $itemRecibo->save();
        }
        return redirect('/clients/'.$recibo->cliente_id.'/show');
    }

    //Buscar parcelas em aberto pelo nome, utilizado na tela Caixa em Aberto
    public function buscarParcelasAberto($nome){
        $parcelas = [];
        $consulta1 = DB::table('parcelas')->where([
            ['nome_cliente','like','%'.$nome.'%'],
            ['status','Em aberto'],
            ['deleted_at',NULL],
            ])->get(); 
        array_push($parcelas, $consulta1);       
        return json_encode($parcelas);
    }

}
