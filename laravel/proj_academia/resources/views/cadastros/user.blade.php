@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuários do sistema</div>

                <div class="card-body">
                    @if (isset($users))
                            
                        <table class="table table-striped table-borderless table-hover">
                            <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Email</th>
                              <th scope="col">Situação</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach($users as $u)
                                <tr>
                                  <th scope="row">{{$u->id}}</th>
                                  <td>{{$u->name}}</td>
                                  <td>{{$u->email}}</td>
                                  <td>@Ativo</td>
                                  <td>
                                    <a href="/cadastros/user/{{$u->id}}/edit" class="btn btn-sm btn-warning">Editar</a>
                                    <a href="/cadastros/user/{{$u->id}}/delete" class="btn btn-sm btn-danger">Excluir</a>
                                  </td>
                                </tr>                                
                            @endforeach                            
                          </tbody>
                        </table>
                            
                    @else
                        <p>Não há usuários cadastrados em sua base de dados</p>
                    @endif
                </div>

                <div class="card-footer">
                    <a class="btn btn-primary" href="/cadastros/formUser">Cadastrar</a>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection
