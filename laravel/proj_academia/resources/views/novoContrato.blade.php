@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tela de Vendas de Contratos</div>
                <form action="/cadastros/plans/postConferirNeg" method="POST">
                @csrf
                <div class="card-body">
                    <fieldset disabled>
                            <div class="form-row">@if(isset($client))
                            <label class="form-control center" for="id_cliente" style="text-align:center; margin: 0 auto;">Aluno{{$client->name}}</label>
                            <input type="hidden" name="client_id" value="{{$client->id}}">
                            </div>
                    </fieldset>
                    <input type="hidden" name="id_cliente" id="id_cliente" value="{{$client->id}}">@endif
                    <br>    
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Plano" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div class="form-row">     
                        <select class="custom-select" name="selectPlan" id="selectPlan">
                            <option selected value="0">Selecionar...</option>
                            @foreach($plans as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>                
                            @endforeach            
                        </select> 
                    </div><br>
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Duração" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div id="durPlan"> 
                        <!-- Incluir duracoes dos planos via jquery-->
                    </div>
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Modalidades" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div id="modalsPlan"> 
                        <!-- Incluir modalidades nos planos via jquery-->                        
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Conferir negociação</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {    
            $("#selectPlan").change(function(){
                montarLinhaDuracao(this.value);
            });
         });
        function montarLinhaDuracao(plan_id){
            if (plan_id==0) {
                $("#durPlan").html('');
                $("#modalsPlan").html('');                
                return false;  
            }
            //Requisição AJAX retornando dados do plano seleciondo
            $.get("/cadastros/plans/"+plan_id+"/details", function(data){
                obj = JSON.parse(data);
                $("#durPlan").html('');                
                $("#modalsPlan").html('');     
                //para cada obj vindo no array duracao           
                $.each(obj["duracoes"], function(i,item){
                    $("#durPlan").append('<input type="radio" value="'+item+'" name="duracao">'+item+'<br>');
                });
                //para cada obj vindo no array modal
                for(i=0; i<obj["modals"].length ; i++){
                    console.log(obj["modals"][i]['modal_id']);
                    $.each(obj["modals"][i],function(name,value){
                        console.log(name,value);
                        $("#modalsPlan").append('<input type="checkbox" value="'+obj["modals"][i]['modal_id']+'" name="modals[]">'+name+' - R$'+value+'<br>');
                        return false;
                    });
                    /*
                    $.each(obj["modals"][i]['modal_id'], function(name,value){
                        //incluir cada chave e valor no div modals
                        $("#modalsPlan").append('<input type="checkbox" value="'+obj["modals"][i]['modal_id']+'" name="modals[]">'+name+' - R$'+value+'<br>');
                          
                    });*/ 
                }
/*
                $.each(obj["modals"], function(i,modal){
                    //incluir cada chave e valor no div modals
                    $.each(modal,function(name,value){
                        $("#modalsPlan").append('<input type="checkbox" value="'+value+'" name="modals[]">'+name+' - R$'+value+'<br>');
                    }); 
                }); 
                
                $.each(obj["modals"], function(i,modal){
                    //incluir cada chave e valor no div modals
                    $.each(modal,function(name,value){
                        $("#modalsPlan").append('<input type="checkbox" value="'+value+'" name="modals[]">'+name+' - R$'+value+'<br>');
                    }); 
                });*/       
            }); 
        }         
    </script>
@endsection