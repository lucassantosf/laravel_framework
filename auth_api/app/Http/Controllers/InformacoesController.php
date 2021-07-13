<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\InformacoesRequest;
use Illuminate\Support\Facades\Session; 
use App\Info;

class InformacoesController extends Controller
{

    public function __construct()
    {
        $this->file_path = public_path().'/uploads/infos/';

        if (!file_exists($this->file_path)) {
            mkdir($this->file_path, 0777, true);
        } 
    }

    public function edit(Request $request, $id)
    {
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */
        if(!$request->user()->authorizeRoles(['1','2','3','4'])) {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }

        $info = Info::findOrFail($id);
        $title = 'Editando: Informações ';

        return view('cms.informacoes.edit', compact('title', 'info'));
    }

    public function update(InformacoesRequest $request, $id)
    {
        $info = Info::findOrFail($id);
        $up = $request->all();

        if($request->hasFile('termos')){

            $arquivo = $this->file_path.$info->termos;

            if (!empty($info->termos) && file_exists($arquivo)) {
               unlink($arquivo);
            }

            $file = $request->file('termos');
            $file_name = time().'-'.$file->getClientOriginalName();
           

            $file->move($this->file_path, $file_name);
            $up['termos'] = $file_name;
        }

        $info->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('informacoes.edit', $id);
    }
}