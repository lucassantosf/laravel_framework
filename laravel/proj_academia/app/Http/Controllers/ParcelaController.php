<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Parcela;
use App\Cliente;

class ParcelaController extends Controller
{
    public function showParcelasVenda($id){
        $parcelas = DB::table('parcelas')->where('venda_id',$id)->get();
        return json_encode($parcelas);
    }

    public function mostrarParcelas(){

        $parcelas = DB::table('parcelas')->where('status','Em aberto')->get();
        foreach ($parcelas as $p) {
        	echo 'id '.$p->id.' venda_id '.$p->venda_id.' value '.$p->value.' status '.$p->status.'<br>';
        }
        exit();
    	return view('operacao.emAberto');
    }

    public function parcelasEmAberto($id){
    	$cliente = Cliente::find($id);
    	return view('operacao.emAberto',compact('cliente'));

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

}
