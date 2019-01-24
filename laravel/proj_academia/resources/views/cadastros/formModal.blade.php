@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i == 0)        
        <!-- Inicio card listagem -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modalidades</div>
                <div class="card-body">
                    <table class="table table-striped table-borderless table-hover">
                            <thead>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">Nome</th>
                              <th scope="col">Valor Mensal</th>
                              <th scope="col">Frequencia</th>
                              <th scope="col">Situação</th>
                              <th scope="col">Ações</th>
                            </tr>
                          </thead>
                          <tbody> 
                                @foreach($modals as $m)
                                <tr>
                                    <th scope="row">{{$m->id}}</th>
                                    <td>{{$m->name}}</td>
                                    <td>R${{$m->value}}</td>
                                    <td>{{$m->freq}}</td>
                                    <td>@if($m->status == 1) Ativo @else Inativo @endif</td>
                                    <td>
                                        <a href="/cadastros/modal/{{$m->id}}/edit" class="btn btn-sm btn-warning">Editar</a>
                                        <a href="/cadastros/modal/{{$m->id}}/delete" class="btn btn-sm btn-danger">Excluir</a>         
                                    </td>
                                </tr> 
                                @endforeach
                          </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/cadastros/formModal" class="btn btn-sm btn-primary">Cadastrar</a>                    
                </div>
            </div>
        </div>
        <!-- Fim card listagem-->
        @endif
        @if($i == 1)
        <!-- Inicio card Cadastro-->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastrar modalidade</div>
                <div class="card-body">
                    @if(!isset($modal))

                    <form action="/cadastros/formModal" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" placeholder="Descrição"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Valor mensal</label>
                            <div class="col-sm-8">
                                <input type="text" name="value" class="form-control" placeholder="R$"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Frequencia</label>
                            <div class="col-sm-4">
                                <input type="text" name="freq" class="form-control" placeholder="Dias na semana"> 
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Ativo
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                </div>
                            </div>
                        </div>

                        @else

                        <form action="/cadastros/modal/{{$modal->id}}/edit" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Nome</label>
                            <div class="col-sm-8">
                                <input type="text" name="name" class="form-control" value="{{$modal->name}}"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Valor mensal</label>
                            <div class="col-sm-8">
                                <input type="text" name="value" class="form-control" value="{{$modal->value}}"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Frequencia</label>
                            <div class="col-sm-4">
                                <input type="text" name="freq" class="form-control" value="{{$modal->freq}}"> 
                            </div>                            
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">Ativo
                            </div>
                            <div class="col-sm-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="A" @if($modal->status == 1) checked  @endif>
                                </div>
                            </div>
                        </div>

                        @endif   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Cadastrar</button>
                    <a href="/cadastros/modals" class="btn btn-sm btn-danger">Cancelar</a>
                    </form>                    
                </div>
            </div>
        </div>
        <!-- Fim card Cadastro-->
        @endif
        
    </div>
</div>
@endsection
