<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PacoteRequest;
use App\Pacote;
use Session;

use PagarMe\Client as PagarMe;

class PacotesController extends Controller
{
    public function index(Request $request)
    {
        /* 1 = Administrador */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $pacotes = Pacote::orderBy('id', 'DESC')->paginate(5);
        $title = "Listando pacotes";

        return view('cms.pacotes.index', compact('title', 'pacotes'));
    }

    public function create(Request $request)
    {
        /* 1 = Administrador */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $title = "Novo pacote";

        return view('cms.pacotes.create', compact('title'));
    }

    public function store(PacoteRequest $request)
    {
        $new = $request->all();

        $valor = str_replace(',','.',str_replace('.','',$request->valor));
        $valor2 = str_replace(',','',str_replace('.','',$request->valor));

        $new['valor'] = $valor;

        Pacote::create($new);

        Session::flash('message', 'Pacote adicionada com sucesso!');
        Session::flash('class', 'success');

        return redirect()->route('pacotes.index');
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $pacote = Pacote::findOrFail($id);
        $title = "Editando: ".$pacote->descricao;

        return view('cms.pacotes.edit', compact('title', 'pacote'));
    }

    public function update(PacoteRequest $request, $id)
    {
        $Pacote = Pacote::findorFail($id);

        $up = $request->all();

        $valor = str_replace(',','.',str_replace('.','',$request->valor));
        $up['valor'] = $valor;

        $Pacote->update($up);

        Session::flash('message', 'Pacote editado com sucesso!');
        Session::flash('class', 'success');

        return redirect()->route('pacotes.edit', $id);
    }

    public function destroy(Request $request,$id)
    {
        /* 1 = Administrador */
        if(!$request->user()->authorizeRoles(['1'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $pacote = Pacote::findOrFail($id);

        $pacote->delete();

        Session::flash('message', 'Pacote removido com sucesso!');
        Session::flash('class', 'danger');

        return redirect()->route('pacotes.index');
    }
}
