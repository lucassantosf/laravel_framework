<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ParcelaController extends Controller
{
    public function showParcelasVenda($id){
        $parcelas = DB::table('parcelas')->where('venda_id',$id)->get();
        return json_encode($parcelas);
    }

    public function mostrarParcelas(){
    	return view('operacao.emAberto');
    }
}
