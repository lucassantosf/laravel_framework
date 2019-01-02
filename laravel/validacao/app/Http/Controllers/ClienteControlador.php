<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteControlador extends Controller
{
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes',compact('clientes'));
    }

    public function create()
    {
        return view('novocliente');
    }

    public function store(Request $request)
    {   
        //validacao com 'traducao'
        $regras = [
            'nome'=>'required|min:5|max:20|unique:clientes',
            'idade'=>'required',
            'endereco'=>'required',
            'email'=>'required|email'
        ];
        $mensagens = [
            'required'=>'O campo :attribute não pode ser vazio',
            //'nome.required'=>'O campo nome é obrigatório',
            'nome.min'=>'É necessário no minimo 5 caracteres no nome.',
            'email.email'=>'Endereço de email não válido'
        ];
        $request->validate($regras,$mensagens);        
        //validacao normal simples
        /*$request->validate([
            'nome'=>'required|min:5|max:20|unique:clientes',
            'idade'=>'required',
            'endereco'=>'required',
            'email'=>'required|email'
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
