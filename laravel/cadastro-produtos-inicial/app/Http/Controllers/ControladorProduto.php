<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Produto;

class ControladorProduto extends Controller
{
     public function index()
    {   
        $prods = Produto::all();
        return $prods->toJson();
    }

    public function indexView()
    {
        return view('produtos');
    }

   
    public function create()
    {
        
    }

    
    public function store(Request $request)
    {
        $prod = new Produto();
        $prod->nome = $request->input('nome');
        $prod->preco = $request->input('preco');
        $prod->estoque = $request->input('estoque');
        $prod->categoria_id = $request->input('categoria_id');
        $prod->save();
        return json_encode($prod);
    }

    public function show($id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            return json_encode($prod);
        }
        return response('Produto não encontrada',404);
    }

    public function edit($id)
    {
        //
    }
    
    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            $prod->nome = $request->input('nome');
            $prod->preco = $request->input('preco');
            $prod->estoque = $request->input('estoque');
            $prod->categoria_id = $request->input('categoria_id');
            $prod->save();
            return json_encode($prod);
        }
        return response('Produto não encontrada',404);
    }

    public function destroy($id)
    {
        $prod = Produto::find($id);
        if(isset($prod)){
            $prod->delete();
            return response('OK',200);
        }
        return response('Produto não encontrado',404);
    }

    public function indexJson(){
        $prods = Produto::all();
        return json_encode($prods);
    }
}
