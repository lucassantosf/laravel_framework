<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Produto;

class ControladorEstoque extends Controller
{
    public function index()
    {   
        return view('relatorios');        
    }

    public function tot()
    {   
        $compras = Produto::with('compras')->get();
        
        foreach ($compras->toJson() as $key => $value) {
            var_dump($compras);
            exit();
        }
        
        return view('relatorios.totalizador',compact('compras'));        
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
