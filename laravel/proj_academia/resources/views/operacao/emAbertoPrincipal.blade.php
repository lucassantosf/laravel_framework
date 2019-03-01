@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                
                <div class="card-header">Caixa em Aberto 
                    < <a href="/home" class="link">Voltar</a>
                </div>
                
                <div class="card-body">                    
                    <div class="input-group input-group-sm mb-3">
                      <input type="text" class="form-control" placeholder="Nome do cliente" id="nomeCliente">
                      <div class="input-group-append">
                        <button class="btn btn-primary btn-sm" onclick="buscarParcelas()">Buscar Parcelas</button>
                        <button class="btn btn-dark btn-sm" onclick="limparCampos()">Limpar Campo</button>
                      </div>
                    </div>

                    <div id="parcelasCliente">
                        
                    </div>

                    <div id="total"><!-- Incluir valor total -->                        
                    </div>
                    
                    
                </div>
                <div class="card-footer"> 
                    <button type="submit" class="btn btn-sm btn-primary">Pagar</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript">
        
        $(document).ready(function() { 
            //
        });

        function buscarParcelas(){
            nomeCliente = $("#nomeCliente").val();
            //se nome estiver vazio mostrar ao user
            if(!nomeCliente == ''){
                //Fazer consulta
                //Requisição AJAX GET retornando parcelas em aberto do plano seleciondo
                $.get("/clients/buscarParcelasAberto/"+nomeCliente, function(data){
                    $("#parcelasCliente").html('');
                    
                    obj = JSON.parse(data);
                    if(obj.length  == 0){
                        $("#parcelasCliente").html('Sem resultados para a pesquisa');   
                    }else{
                        $("#parcelasCliente").html('');   
                        $.each(obj, function(i,item){
                            $("#parcelasCliente").append('<input type="checkbox" class="parcela" name="parcela[]" id="'+obj[i].id+'" value="'+obj[i].id+'">'+ 'Cod ' + obj[i].id + ' R$ ' + '<label for="'+obj[i].id+'">'+obj[i].value + '</label>'+ ' Responsável ' + obj[i].nome_cliente + '<br>');
                        });
                    }
                });
            }else{
                alert('Pesquisa Vazia');
                return false;
            }
        }
        //limpar campo de pesquisa do nome do cliente
        function limparCampos(){
            $("#nomeCliente").val('');            
            $("#parcelasCliente").html('');            
        }

        function calcularValorTotal(valor){
            total = valor;
            $(".parcela").change(function(){
                alert('change'); 
                if($(this).prop("checked") == true){
                    $("#total").html('');                    
                    label = $(this).prop("labels");
                    text = $(label).text();
                    valor = parseFloat(text);
                    total = total + valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append('R$');   
                    $("#total").append(total.toFixed(2));   
                                      
                }else{
                    $("#total").html('');                    
                    label = $(this).prop("labels");
                    text = $(label).text();
                    valor = parseFloat(text);
                    total = total - valor;
                    $("#total").append('<input type="hidden" name="valorTotal" value="'+total.toFixed(2)+'"> '); 
                    $("#total").append('R$');   
                    $("#total").append(total.toFixed(2)); 
                }
            });
        }
    </script>
@endsection