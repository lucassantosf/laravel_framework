<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Especialidade; 
use App\Plano;

class FiltrosController extends Controller
{ 
    //Filtrar especialidades por nome
    public function especialidadebusca(Request $request)
    {
        $buscar = $request->all();
        $especialidades = Especialidade::where('descricao', 'like', '%'.$buscar['busca'].'%')->orderBy('id', 'DESC')->paginate(10);
        
        $title = "Listando Especialidades - Resultado por: ".$buscar['busca'];
        return view('cms.especialidades.index', compact('title', 'especialidades'));
    }

    //Filtrar planos por nome
    public function planobusca(Request $request)
    {
        $buscar = $request->all();
        $planos = Plano::where('descricao', 'like', '%'.$buscar['busca'].'%')->orderBy('id', 'DESC')->paginate(10);
        
        $title = "Listando Planos - Resultado por: ".$buscar['busca'];
        return view('cms.planos.index', compact('title', 'planos'));
    } 
}