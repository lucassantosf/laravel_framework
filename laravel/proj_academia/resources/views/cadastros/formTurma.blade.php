@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if($i==0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col-sm-1">#</th>
                        <th scope="col-sm-1">Descrição</th>
                        <th scope="col-sm-1">Modalidade</th> 
                        <th scope="col">Status</th>
                        <th scope="col"><a href="/cadastros/formTurma" class="btn btn-outline-info">Cadastre</a></th>
                    </tr>
                </thead>
                <tbody>
                        <tr>
                            <td><span class="badge badge-light">id</span></td>
                            <td><span class="badge badge-primary">descricao</span></td>
                            <td><span class="badge badge-primary">modal x</span></td>                
                            <td>@ativa</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning">Editar</a>
                                <a href="#" class="btn btn-sm  btn-danger">Apagar</a>
                            </td>
                        </tr> 
                </tbody>   
            </table>
        @endif
        @if($i==1)
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Cadastrar Turmas</div>
                <div class="card-body">                         
                    <form action="/cadastros/formTurma" method="POST"><br>
                        @csrf
                        <div class="form-row">
                            <label class="col-sm-3">Descrição da turma</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Descrição">
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="col-sm-3">Modalidade</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Descrição">
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="col-sm-3">Status</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Descrição">
                            </div>
                        </div>
                        <div class="form-row">
                            <label class="col-sm-3">Horários</label>
                            <button class="btn btn-danger" onclick="incluirLinhaHora(this)">+</button>
                        </div>
                        <table class="table table-striped" id="table_horarios">
                            <thead>
                                <tr>
                                    <th scope="col-sm-1">Hora Inicio</th>
                                    <th scope="col-sm-1">Hora Fim</th>
                                    <th scope="col-sm-1">Vagas</th> 
                                    <th scope="col">#</th> 
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>00:00</td>
                                        <td>00:00</td>
                                        <td>4</td>                
                                        <td>
                                            <button class="btn btn-danger" onclick="apagarLinhaHora(this)">-</button>
                                        </td>
                                    </tr> 
                            </tbody>   
                        </table>

                    </form>
                </div>                 
                <div class="card-footer">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{$error}}
                            </div>
                        @endforeach
                    @endif     
                </div>
            </div>            
        </div>
        @endif
    </div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {   
            console.log('Cadastro Turmas');             
        });

        function apagarLinhaHora(data){
            $(data).parents('tr').remove(); 
            console.log('Remover Horário');
            return false;
        }

        function incluirLinhaHora(data){
            $('#table_horarios').append('<tr><td>00:00</td><td>00:00</td><td>4</td><td><button class="btn btn-danger" onclick="apagarLinhaHora(this)">-</button></td></tr>');
            console.log('Adicionar Horário');
            return false;
        }

    </script>    
@endsection
