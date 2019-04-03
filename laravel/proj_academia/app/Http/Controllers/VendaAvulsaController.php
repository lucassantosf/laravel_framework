<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendaAvulsa;
use App\ItemVendaAvulsa;
use App\ParcelaVendaAvulsa;
use App\Cliente;
use App\Produto;

class VendaAvulsaController extends Controller
{
    public function postVenda(Request $request){
    	//Salvar a venda avulsa	    
    	$cliente = Cliente::find($request->input("nomesClientes"));
        if(isset($cliente)){
    	$venda_avulsa = new VendaAvulsa();
    	$venda_avulsa->desconto = $request->input("desconto");
    	$venda_avulsa->value = $request->input("vlTotal");
    	$venda_avulsa->cliente_id = $cliente->id;
    	$venda_avulsa->save();
    	//Dentro da venda avulsa salvar cada item da compra
    	$prods = $request->input("prods");
        foreach($prods as $p){
        	$produto = Produto::find($p);
        	$item_venda_avulsa = new ItemVendaAvulsa();
        	$item_venda_avulsa->produto_id = $p;
        	$item_venda_avulsa->descricao_produto = $produto->name;
        	$item_venda_avulsa->venda_avulsa_id = $venda_avulsa->id;
        	$item_venda_avulsa->save();
        }        	
        //Gerar a parcela única da venda avulsa
    	$parcelaVendaAvulsa = new ParcelaVendaAvulsa();
    	$parcelaVendaAvulsa->venda_avulsa_id = $venda_avulsa->id;
    	$parcelaVendaAvulsa->value = $venda_avulsa->value;
    	$parcelaVendaAvulsa->cliente_id = $cliente->id;
    	$parcelaVendaAvulsa->nome_cliente = $cliente->name;
    	$parcelaVendaAvulsa->save();
        }
    	return redirect('/home');
    }
}
