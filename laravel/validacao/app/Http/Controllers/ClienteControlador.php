<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteControlador extends Controller
{   
    public function index()
    {   
        $cli = Cliente::all();
        return view('clientes',compact('cli'));
    }

    public function create()
    {
        return view('novocliente');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'nome'=>'required|min:5|max:100',
            'email'=>'unique:clientes'
        ]); 
        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->idade = $request->input('idade');
        $cliente->endereco = $request->input('endereco');
        $cliente->email = $request->input('email');
        $cliente->save();
        return redirect('/');
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
