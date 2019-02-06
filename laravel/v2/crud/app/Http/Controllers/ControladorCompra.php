<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Compra;

class ControladorCompra extends Controller
{
    public function index()
    {   
        $prods = Produto::all();
        $buys = Compra::all();
        return view('compras',compact('buys','prods'));        
    }

    public function create()
    {   
        $prods = Produto::all();
        return view('forms/formCompra',compact('prods'));
    }

    public function store(Request $request)
    {
        $buy = new Compra();
        $buy->produto_id = $request->input('Produto');
        $buy->qtd = $request->input('qtdProduto');
        $buy->save();
        return redirect('/compras');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
