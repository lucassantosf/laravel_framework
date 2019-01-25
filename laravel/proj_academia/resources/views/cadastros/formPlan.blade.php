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
                        <div class="form-group row">
                            <label class="col-sm-3">Descrição</label>
                            <div class="col-md-9">
                                <input type="text" name="name" class="form-control" placeholder="Descrição">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3">Durações</label>
                            <div class="col-sm-9" id="listas">                
                                <input type="text" name="0" id="0" placeholder="Meses">
                                <input type="button" id="add_field" value="+">                        
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <div class="col-sm-3">Modalidades</div>
                            <div class="col-sm-9">
                                <div class="form-check form-check-inline">
                                    <select multiple name="lista1" id="lista1">
                                        @foreach($modals as $m)
                                            <option value="{{$m->id}}">{{$m->name}}</option>
                                        @endforeach
                                      
                                    </select>
                                    <input type="button" id="add_modal" value="+" onclick="getModalsId()">
                                    <div id="lista2">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>

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
                dur = $('#'+d).val();
                duracoes.push(dur);
                d++;
                $('#listas').append('<div>\
                    <input type="text" id='+d+' name='+d+'>\
                    <a href="#" class="remover_campo">-</a>\
                    </div>');       
            });

            // Remover o div de durações
            $('#listas').on("click",".remover_campo",function(e) {
                e.preventDefault();
                $(this).parent('div').remove();          
            });
            
            //Adicionar modalidades entre os selects
            $('#add_modal').on("click",function(e) {                
                e.preventDefault();//prevenir novos clicks
                var texto = $("#lista1 option:selected").text();
                var itemSelecionado = $("#lista1 option:selected").val();
                $('#lista2').append('<option name="'+itemSelecionado+'">'+texto+'</option>');
                modals.push(itemSelecionado);    
            });

        });

        function getModalsId(){
            return this.modals;
        }

        function getDur(){
            return this.duracoes;
        }

    </script>
@endsection
