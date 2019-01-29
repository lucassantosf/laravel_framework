@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    <!-- Exibir todos os planos -->
    @if($i==0)
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col-sm-1">#</th>
              <th scope="col-sm-1">Duracoes</th>
              <th scope="col">Modalidades</th>
              <th scope="col">Status</th>
              <th scope="col">Ações</th>
            </tr>
          </thead>
          <tbody>
            @foreach($plans as $p)
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->name}}</td>
                    <td>
                    @foreach($duracoes as $d)                        
                        @if($d->plano_id == $p->id)
                            {{$d->duracao}}                         
                        @endif                        
                    @endforeach
                    </td>
                <td>
                @foreach($mp_id as $mp)
                    @foreach($modals as $m)
                        @if($mp->plano_id == $p->id && $mp->modal_id == $m->id)
                            {{$m->name}}
                        @endif
                    @endforeach
                @endforeach
                </td>
                    <td>@if($p->status == 1) Ativo @else Inativo @endif</td>
                    <td>
                        <a href="/cadastros/plan/{{$p->id}}/edit" class="btn btn-sm btn-warning">Editar</a>
                        <a href="/cadastros/plan/{{$p->id}}/delete" class="btn btn-sm  btn-danger">Apagar</a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <!-- Form para cadastro-->
    @if($i==1)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastro de Planos</div>

                <div class="card-body">
                    
                    <form action="/cadastros/formPlan" method="POST">
                        @csrf
                        <div class="form-row">
                            <label class="col-sm-3">Descrição</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" placeholder="Descrição">
                            </div>
                        </div>
                        <br>
                        <div class="form-row" id="duracoes">      

                            <label class="col-sm-3">Durações</label>                              
                            <div class="col-sm-1">  
                                <input type="button" class="form-control btn btn-primary btn-sm" id="add_field" value="+">
                            </div>
                            <div class="col-sm-1">              
                                <input type="text" class="form-control" name="duracao[]" >
                            </div>                         
                            
                        </div>
                        <br>

                        <div class="form-row">                            
                            <div class="col-sm-3">Modalidades</div>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <select multiple class="custom-select" name="lista1" id="lista1">
                                        @foreach($modals as $m)
                                            <option value="{{$m->id}}">{{$m->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                    <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                                    <div id="lista2" class="col-sm-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">                            
                            <div class="col-sm-3">Ativo</div>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                </div>
                            </div>
                        </div>
                                    
                </div>
                <div class="card-footer">      
                    <button class="btn btn-primary btn-sm" type="submit">Cadastrar</button>
                    </form>              
                </div>

            </div>
        </div>
    @endif

    <!-- Form para editar o plano-->
    @if($i==2)
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cadastro de Planos</div>
                <div class="card-body">
                   
                    <form action="/cadastros/formPlan" method="POST">
                        @csrf
                        <div class="form-row">
                            <label class="col-sm-3">Descrição</label>
                            <div class="col-sm-9">
                                <input type="text" name="name" class="form-control" value="{{$plan->name}}">
                            </div>
                        </div>
                        <br>
                        
                        <div class="form-row" id="duracoes">      

                            <label class="col-sm-3">Durações</label>                              
                            <div class="col-sm-1">  
                                <input type="button" class="form-control btn btn-primary btn-sm" id="add_field" value="+">
                            </div>
                            <div class="col-sm-1">              
                                <input type="text" class="form-control" name="duracao[]" >
                            </div>                         
                            
                        </div>
                        <br>

                        <div class="form-row">                            
                            <div class="col-sm-3">Modalidades</div>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <select multiple class="custom-select" name="lista1" id="lista1">
                                       
                                      
                                    </select>
                                    <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                                    <div id="lista2" class="col-sm-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">                            
                            <div class="col-sm-3">Ativo</div>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="status" name="status" value="A">
                                </div>
                            </div>
                        </div>
                                    
                </div>
                <div class="card-footer">      
                    <button class="btn btn-primary btn-sm" type="submit">Editar</button>
                    </form>              
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
                                                      
            //Campos de durações
            $('#add_field').click (function(e) {                
                e.preventDefault();     //prevenir novos clicks                                
                $('#duracoes').append('<div class="col-sm-1">\
                        <input type="text"  class="form-control" name="duracao[]">\
                        <button href="#" class="btn btn-danger btn-sm remover_campo">-</button>\
                    </div>');       
            });

            // Remover o div de durações
            $('#duracoes').on("click",".remover_campo",function(e) {
                e.preventDefault();
                $(this).parent('div').remove();          
            });
            
            //Adicionar modalidades entre os selects
            $('#add_modal').on("click",function(e) {                
                e.preventDefault();//prevenir novos clicks
                var texto = $("#lista1 option:selected").text();
                var itemSelecionado = $("#lista1 option:selected").val();
                $('#lista2').append('<input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'<br>');            

            });

        });

        

    </script>
@endsection
