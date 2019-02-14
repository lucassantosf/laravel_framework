@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tela de Vendas de Contratos</div>

                <div class="card-body">
                    <fieldset disabled>
                            <div class="form-row">@if(isset($client))
                            <input placeholder="Aluno {{$client->name}}" class="form-control center" style="text-align:center; margin: 0 auto;">@endif
                            </div>
                    </fieldset><br>    
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Plano" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div class="form-row">     
                        <select class="custom-select" name="lista" id="lista">
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
                    <div class="form-row" id="durPlan">
                    
                    </div>
                     
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {    
            $("#lista").change(function(){
                montarLinhaDuracao(this.value);
            });
         });
        function montarLinhaDuracao(plan_id){
            if (plan_id==0) {
                $("#durPlan").html('');   
                return false;  
            }
            //Requisição AJAX retornando dados do plano seleciondo
            $.get("/cadastros/plans/"+plan_id+"/details", function(resultado){
                $("#durPlan").html('');                
                $("#durPlan").append(resultado);
            }); 
        }         
    </script>
@endsection