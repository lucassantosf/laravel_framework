@extends('layouts.app')
 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Realizar Venda < <a href="/home">Voltar</a></div>

                <div class="card-body">
                    @if(isset($cliente_id))
                        {{$cliente_name}}
                    @else
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanCliente">Escolha um cliente</span>
                            </div>
                            <input type="text" class="form-control" id="nomeCliente">
                            <select class="form-control" id="nomesClientes">             
                            </select>
                        </div><hr>
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanProduto">Escolha um produto</span>
                            </div>
                            <input type="text" class="form-control" id="nomeProduto">
                            <select class="form-control" id="nomesProdutos">             
                            </select>
                            <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                        </div>
                        <table class="table" id="produtos">
                            <tbody>  
                                         
                            </tbody>
                        </table>
                    @endif
                </div>
                 
            </div>
        </div>
    </div>
</div>
@endsection
@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {   
            
            carregarSelectClientes();
            carregarSelectProdutos();

            $('#add_modal').on("click",function(e) {
                var texto = $("#nomesProdutos option:selected").text(); 
                var itemSelecionado = $("#lista option:selected").val();
                $('#produtos').append('<tr>'+
                                          '<td><input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                                          '<td><input type="button" class="btn-danger excluir" id="excluir" value="-" onclick="remover(this)"></td>'+             
                '</tr>');
            });
        });

        function limparSelectClient(){
            $('#nomesClientes option').each(function() {
                $(this).remove();
            });
        }

        function limparSelectProduct(){
            $('#nomesProdutos option').each(function() {
                $(this).remove();
            });
        }

        function carregarSelectClientes(){ 
            var textInput = document.getElementById('nomeCliente');
            // Init a timeout variable to be used below
            var timeout = null;
            // Listen for keystroke events
            nomeCliente.onkeyup = function (e) {
                // Clear the timeout if it has already been set.
                // This will prevent the previous task from executing
                // if it has been less than <MILLISECONDS>
                clearTimeout(timeout);
                // Make a new timeout set to go off in 800ms
                timeout = setTimeout(function () {
                    limparSelectClient();         
                    $.get("/vendas/searchClientByName/"+textInput.value, function(data){
                        for (i = 0; i < data.length; i++) {                   
                            $("#nomesClientes").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                        }
                    });
                }, 500);
            };
        }

        function carregarSelectProdutos(){
            var textInput = document.getElementById('nomeProduto');
            var timeout = null;
            nomeProduto.onkeyup = function (e) {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    limparSelectProduct();         
                    $.get("/vendas/searchProdByName/"+textInput.value, function(data){
                        for (i = 0; i < data.length; i++) {                   
                            $("#nomesProdutos").append('<option value="'+data[i].id+'">'+data[i].name+'</option>');
                        }
                    });
                }, 500);
            };
        }
         
    </script>
@endsection


