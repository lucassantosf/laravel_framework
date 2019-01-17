<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contato;

class ContatoController extends Controller
{
    public function index(){
    }

    public function indexJson(){
        $prods = Contato::all();
        return $prods->toJson();
    }

    public function create()
    {
        return view('forms/formContato');        
    }

    public function store(Request $request)
    {   
        //validacao com 'msgs'
        $regras = [
            'nome'=>'required|min:5|max:50|unique:contatos',
            'email'=>'required|email',
            'idade'=>'required|max:3',        
            'telefone'=>'required|min:11',
        ];
        $mensagens = [
            'required'=>'O campo de :attribute não pode ser vazio',            
            'nome.min'=>'É necessário no minimo 5 caracteres no campo nome',
            'telefone.min'=>'Campo de telefone incompátivel',
            'idade.max'=>'Idade não pode ter mais que 3 caracteres',
            'email.email'=>'Formato do email não é válido',
        ];
        $request->validate($regras,$mensagens);
            
        $cont = new Contato();
        $cont->nome = $request->input('nome');
        $cont->email = $request->input('email');
        $cont->idade = $request->input('idade');
        $cont->telefone = $request->input('telefone');
        $cont->save();
        return redirect('/');
    }

    public function listar(){
        $conts = Contato::all();
        return view('listarContatos',compact('conts'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $contact = Contato::find($id);
        if(isset($contact)){
            return view('forms.formContatoEdit',compact('contact'));
        }
    }

    public function update(Request $request, $id)
    {
        $cont = Contato::find($id);
        if(isset($cont)){
            $cont->nome = $request->input('nome');
            $cont->email = $request->input('email');
            $cont->idade = $request->input('idade');
            $cont->telefone = $request->input('telefone');
            $cont->save();
        }        
        return redirect('/');
    }

    public function destroy($id)
    {
        $cont = Contato::find($id);
        if(isset($cont)){
            $cont->delete();
        }
        return redirect('/cadastrar');
    }
}
