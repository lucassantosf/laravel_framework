<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;

use App\User;
use App\Role;
use Auth;

use App\Http\Requests\UsersRequest;
use App\Http\Requests\UserEditRequest;
use App\Mail\Welcome;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */

        if($request->user()->authorizeRoles(['1','2'])) {
            $usuarios = User::orderBy('id', 'DESC')->paginate(10);
            $title = "Listando Usuários";

            return view('cms.usuarios.index', compact('title', 'usuarios'));

        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */

        if($request->user()->authorizeRoles(['1','2'])) {
            $roles = Role::all();
            $title = "Novo usuário";

            return view('cms.usuarios.create', compact('title', 'roles'));

        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    public function store(UsersRequest $request)
    {
        $new = $request->all();

        $sendto = $new['email'];

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName();
            $file_path = 'uploads/';

            $file->move($file_path, $file_name);

            if($new['image'] != "") {
                $new['image'] = $file_name;
            }
        }

        /* Adicionar dados do cadastro em array, resgatando a senha antes de ser encriptada */
        $data = [
            'title'=> 'Conta foi criada!',
            'name'=> $new['name'],
            'email'=> $new['email'],
            'password'=> $new['password']
        ];

        $new['password'] = bcrypt($request->password);

        /* Enviar e-mail para o usuário com sua senha de acesso */
        Mail::to($sendto)->send(new Welcome($data));

        User::create($new);

        Session::flash('message', 'Adicionado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('usuarios.index');
    }

    public function edit($id)
    {
        $user = Auth::user();
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */

        $roles = Role::all();
        $usuario = User::findOrFail($id);

        if($user->role_id == 1 || $user->id == $usuario->id) {
            $title = "Editando: ".$usuario->name;

            return view('cms.usuarios.edit', compact('title', 'usuario', 'roles'));

        } else {
            $title = "Acesso não autorizado";
            return view('cms.errors.401', compact('title'));
        }
    }

    public function update(UserEditRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $up = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $file_name = time().'-'.$file->getClientOriginalName();
            $file_path = 'uploads/';

            $file->move($file_path, $file_name);

            if($up['image'] != "") {
                $up['image'] = $file_name;
            }
        }

        if($request->password != "") {
            $up['password'] = bcrypt($request->password);
        } else {
            $up['password'] = $user->password;
        }

        $user->update($up);

        Session::flash('message', 'Editado com sucesso!');
        Session::flash('class', 'success');
        return redirect()->route('usuarios.edit', $id);
    }

    public function destroy(Request $request, $id)
    {
        $user = Auth::user();
        /* 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator */

        if($request->user()->authorizeRoles(['1','2'])) {
            $user = User::findOrFail($id);

            $user->delete();

            Session::flash('message', 'Removido com sucesso!');
            Session::flash('class', 'danger');
            return redirect()->route('usuarios.index');

        } else {
            $title = "Acesso não autorizado";
            return redirect('cms.errors.401', compact('title'));
        }
    }
}