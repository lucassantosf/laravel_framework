<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EspecialidadesRequest;
use Illuminate\Support\Facades\Session;

use App\Especialidade;

class EspecialidadesController extends Controller
{
    public function index(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $especialidades = Especialidade::orderBy('id', 'DESC')->paginate(5);
        $title = "Listando Especialidades";

        return view('cms.especialidades.index', compact('title', 'especialidades'));
    }

    public function create(Request $request)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $title = "Nova especialidade";

        return view('cms.especialidades.create', compact('title'));
    }

    public function store(EspecialidadesRequest $request)
    {
        $new = $request->all();
        Especialidade::create($new);

        Session::flash('message', 'Especialidade adicionada com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('especialidades.index');
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $especialidade = Especialidade::findOrFail($id);
        $title = "Editando: ".$especialidade->descricao;

        return view('cms.especialidades.edit', compact('title', 'especialidade'));
    }

    public function update(EspecialidadesRequest $request, $id)
    {
        $especialidade = Especialidade::findOrFail($id);
        $up = $request->all();
        $especialidade->update($up);

        Session::flash('message', 'Especialidade editada com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('especialidades.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $especialidade = Especialidade::findOrFail($id);

        //verify perguntas
        $perguntas = $especialidade->perguntas()->count();
        if($perguntas>0){
            Session::flash('message', 'Especilidade relacionada com perguntas cadastradas! Ação não permitida');
            Session::flash('class', 'danger');
            return redirect()->route('especialidades.index');
        }

        $especialidade->delete();

        Session::flash('message', 'Especilidade removida com sucesso!');
        Session::flash('class', 'danger');
        return redirect()->route('especialidades.index');
    }
}
