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
                            <option selected>Selecionar...</option>
                            @foreach($plans as $p)
                                <option value="{{$p->id}}">{{$p->name}}</option>
                
                            @endforeach            
                        </select> 
                    </div><br>
                    <fieldset disabled>
                        <div class="form-row"> 
                        <input placeholder="Duração" class="form-control center" style="text-align:center; margin: 0 auto;"></div>
                    </fieldset>
                    <div class="form-row" id="durdaPlan">
                    @if(isset($duracoes))
                        @foreach($duracoes as $d)
                            @if($d->plano_id == $plan_id)
                                {{$d->plano_id}}
                            @endif
                        @endforeach
                    @endif
                    </div>
                    <div class="form-row" id="durPlan">

                    @if(isset($duracoes))
                        @foreach($duracoes as $d)
                            @foreach($plans as $p)

                                @if($d->plano_id == $p->id)
                                <div class="class-{{$p->id}}" style="display: none;" id="class-{{$p->id}}">
                                    <input type="radio" name="duracao" value="{{$d->duracao}}"/>{{$d->duracao}}<br/>
                                </div>
                                @endif

                            @endforeach
                        @endforeach
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        let alreadyDuration = false;

        $(document).ready(function() {    
            $("#durPlan").append('');
            
            $("#lista").change(function(){
                montarLinhaDuracao(this.value);
            });
        });

        function montarLinhaDuracao(plan_id){
            if(this.alreadyDuration){
                $("#durPlan").remove();
                $(".class-"+plan_id).show();

                this.alreadyDuration = false;
            }else{
                $(".class-"+plan_id).show();
                this.alreadyDuration = true;
            }
        }

         
    </script>
@endsection