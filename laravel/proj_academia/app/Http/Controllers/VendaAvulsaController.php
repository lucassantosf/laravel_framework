<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VendaAvulsa;
use App\ItemVendaAvulsa;

class VendaAvulsaController extends Controller
{
    public function postVenda(Request $request){
    	//Salvar a venda avulsa	    	
    	$venda_avulsa = new VendaAvulsa();
    	$venda_avulsa->desconto = $request->input("desconto");
    	$venda_avulsa->value = $request->input("vlTotal");
    	$venda_avulsa->save();
    	//Para cada venda avulsa salvar os itens
    	$prods = $request->input("prods");
        foreach($prods as $p){
        	$item_venda_avulsa = new ItemVendaAvulsa();
        	$item_venda_avulsa->produto_id = $p;
        	$item_venda_avulsa->venda_avulsa_id = $venda_avulsa->id;
        	$item_venda_avulsa->save();
        }
    	return redirect('/home');
    }
}
