@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
    </div>
</div>
@endsection

@section('javascript')
    

    <script type="text/javascript">
        
        modals = [];
        duracoes = [];
        d = 0;
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
