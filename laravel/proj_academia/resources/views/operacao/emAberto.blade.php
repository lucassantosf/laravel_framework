@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">Caixa em Aberto de {{$cliente->name}} 
                    < <a href="/clients/{{$cliente->id}}/show" class="link">Voltar</a>
                </div>
                
                <div class="card-body">
                    <form action="/clients/caixaAberto/pagarParcela" method="POST"> @csrf
                    <input type="hidden" name="client_id" value="{{$cliente->id}}">
                    <label class="alert alert-primary">Selecione as parcelas</label><br>
                    @if(isset($parcelas))
                        @foreach($parcelas as $p)
                            <input type="checkbox" class="parcela" name="parcela[]" value="{{$p->value}}">Cod Parcela {{$p->id}} - R$ {{$p->value}}<br>
                        @endforeach
                    @endif
                    <br>
                    <div id="total"><!-- Incluir valor total -->                        
                    </div>
                </div>
                <div class="card-footer"> 
                    <button type="submit" class="btn btn-sm btn-primary">Pagar</button>
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
            
            calcularValorTotal();

        });

        function calcularValorTotal(){
            total = 0;
            $(".parcela").change(function(){
                if($(this).prop("checked") == true){
                    $("#total").html('');
                    valor = parseFloat(this.value);
                    total = total + valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append(total.toFixed(2));   
                                      
                }else{
                    $("#total").html('');
                    valor = parseFloat(this.value);
                    total = total - valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append(total.toFixed(2));                            

                }
            });
        }

    </script>
@endsection


