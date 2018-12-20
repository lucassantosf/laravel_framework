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

        //Modo das validacao com mensagens customizadas
        $regras = [
            'nome'=>'required|max:100|min:5',
            'idade'=>'required',
            'endereco'=>'required|min:5',
            'email'=>'unique:clientes|email'
        ];
        $mensagens = [
            'required' => 'Campo :attribute não pode estar em branco',
            'nome.max' => 'O nome precisa ter maximo de 100 caracteres',
            'nome.min' => 'O nome precisa ter o minimo de 5 caracteres',            
            'email.email'=> 'Digite um email válido'
        ];
        $request->validate($regras,$mensagens);
        
        //Modo de validacao normal
        /*$request->validate([
            'nome'=>'required|max:100',
            'idade'=>'required',
            'endereco'=>'required|min:5',
            'email'=>'unique:clientes|email'
        ]);*/ 

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
