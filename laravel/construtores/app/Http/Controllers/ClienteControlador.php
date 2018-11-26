<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteControlador extends Controller
{
   
    public function index()
    {
        return 'Lista de todos clientess';
    }
    
    public function create()
    {
        return "Formulário para cadastrar novo cliente";
    }
    
    public function store(Request $request)
    {
        $s = "Armazenar :";
        $s .= "Nome: ".$request->input('nome')." e ";
        $s .= "Idade: ".$request->input('idade');
        return response($s, 201);
    }
    
    public function show($id)
    {
        $v = ["nome1","nome2","nome3","nome4"];
        if($id >= 0 && $id < count($v)){
            return $v[$id];
        } else{
            return "Nao encontrado";
        }
    }
    
    public function edit($id)
    {
        return "Formulário para editar com cliente com id ".$id;
    }
    
    public function update(Request $request, $id)
    {
        $s = "Atualizar cliente com id : $id ";
        $s .= "Nome: ".$request->input('nome')." e ";
        $s .= "Idade: ".$request->input('idade');
        return response($s, 200);
    }
    
    public function destroy($id)
    {
        return response("Apagado com sucesso ID: $id", 200 )
    }

    public function requisitar(Request $request){
        echo "nome ".$request->input('nome');
    }

}
