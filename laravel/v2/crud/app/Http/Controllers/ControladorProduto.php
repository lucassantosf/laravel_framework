<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;

class ControladorProduto extends Controller
{
    public function index()
    {   
        $prods = Produto::all();
        return view('produtos',compact('prods'));
    }

    public function create()
    {
        return view('forms/formProduto');
    }

    public function store(Request $request)
    {
        $prod = new Produto();
        $prod->nome = $request->input('nomeProduto');
        $prod->preco = $request->input('precoProduto');
        $prod->estoque_minimo = $request->input('qtdProduto');
        $prod->save();
        return redirect('/produtos');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $prod = Produto::find($id);
        if (isset($prod)) {
            return view('forms.formProdutoEdit',compact('prod'));
        }else{
            return redirect('/produtos');
        }
    }

    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);
        if (isset($prod)) {
            $prod->nome = $request->input('nomeProduto');
            $prod->preco = $request->input('precoProduto');
            $prod->estoque_minimo = $request->input('qtdProduto');
            $prod->save();
        }
        return redirect('/produtos');
    }

    public function destroy($id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            $prod->delete();
        }
        return redirect('/produtos');
    }
}
