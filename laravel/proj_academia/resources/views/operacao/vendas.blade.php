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
                    <form action="/vendas/viewPost" method="POST">@csrf
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanCliente">Escolha um cliente</span>
                            </div>
                            <input type="text" class="form-control" id="nomeCliente" name="nomeCliente">
                            <select class="form-control" id="nomesClientes" name="nomesClientes">    
                                <!-- Incluir nomes pesquisados -->     
                            </select>
                        </div><hr>
                        <div class="input-group input-group-sm mb-12">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanProduto">Escolher produtos</span>
                            </div>
                            <input type="text" class="form-control" id="nomeProduto" disabled>
                            <select class="form-control" id="nomesProdutos">
                                <!-- Produtos incluidos ao ser pesquisado -->
                            </select>
                            <input type="button" id="add_modal" class="btn btn-primary btn-sm" value="+">
                        </div><br>
                        <table class="table" id="produtos">
                            <tbody>  
                                <!-- Produtos incluido dinamicamente -->     
                            </tbody>
                        </table><hr>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanDesconto">Desconto</span>
                            </div>
                            <input type="text" class="form-control" id="desconto" name="desconto" disabled>                             
                        </div>
                        <hr>
                        <div class="input-group input-group-sm">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="spanVlTotal">Valor Total</span>
                            </div>
                            <input type="text" class="form-control" id="vlTotal" name="vlTotal">                             
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    <button class="btn btn-primary btn-sm" type="submit">Confirmar Venda</button>
                    </form>
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
            let lastProductValue;
            let valueTotal;
            let memoryBeforeDesconto;
            let memoryDesconto;

            setValueTotal(0);
            carregarSelectClientes();
            carregarSelectProdutos();
            addProductOnTable();
            listenDesconto();
        });
        //Área de Getters e Setters
        function getLastProductValue(){
            return parseFloat(this.lastProductValue);
        }
        function setLastProductValue(valor){
            this.lastProductValue = valor;
        }
        function getValueTotal(){
            return parseFloat(this.valueTotal);
        }
        function setValueTotal(valor){
            this.valueTotal = valor;
        }
        function getmemoryBeforeDesconto(){
            return parseFloat(this.memoryBeforeDesconto);
        }
        function setmemoryBeforeDesconto(valor){
            this.memoryBeforeDesconto = valor;
        }
        function getMemoryDesconto(){
            return parseFloat(this.memoryDesconto);
        }
        function setMemoryDesconto(valor){
            this.memoryDesconto = valor;
        }
        //Adicionar produto selecionado na tabela de produtos
        function addProductOnTable(){
            $('#add_modal').on("click",function(e) {
                var texto = $("#nomesProdutos option:selected").text(); 
                valorSelected  = $("#nomesProdutos option:selected").data("valor"); 
                setLastProductValue(valorSelected); 
                var itemSelecionado = $("#nomesProdutos option:selected").val();
                $('#produtos').append('<tr>'+
                                          '<td><input type="hidden" name="modals[]" value="'+itemSelecionado+'">'+texto+'</td>'+
                                          '<td><input type="button" class="btn-danger excluir" id="excluir" value="x" onclick="remover(this,'+valorSelected+')"></td>'+             
                '</tr>');
                setValueTotal(getValueTotal() + getLastProductValue());
                setmemoryBeforeDesconto(getValueTotal());
                $("#vlTotal").val(getValueTotal());
                $("#desconto").prop("disabled", false);
            });
        }
        //Remover options quando campo de pesquisa esta vázio
        function limparSelectClient(){
            $('#nomesClientes option').each(function() {
                $(this).remove();
            });
        }
        //Remover options quando campo de pesquisa esta vázio
        function limparSelectProduct(){
            $('#nomesProdutos option').each(function() {
                $(this).remove();
            });
        }
        //Adicionar options em select de acordo ao pesquisado pelo user
        function carregarSelectClientes(){ 
            var textInput = document.getElementById('nomeCliente');
            // Init a timeout variable to be used below
            var timeout = null;
            // Listen for keystroke events
            nomeCliente.onkeyup = function (e) {
                //Se nome estiver vazio desabilitar campo pesquisa de produtos
                if (nomeCliente == '') {
                    $("#nomeProduto").prop("disabled", true);    
                    return false;                                    
                }
                //Habilitar campo de pesquisa para produtos
                $("#nomeProduto").prop("disabled", false);
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
        //Adicionar options em select de acordo ao pesquisado pelo user        
        function carregarSelectProdutos(){
            var textInput = document.getElementById('nomeProduto');
            var timeout = null;
            nomeProduto.onkeyup = function (e) {
                //Se pesquisa de produtos ficar vazia não consumir pesquisa
                if (nomeProduto == '') {
                    return false;                                    
                }
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    limparSelectProduct();         
                    $.get("/vendas/searchProdByName/"+textInput.value, function(data){
                        for (i = 0; i < data.length; i++) {                   
                            $("#nomesProdutos").append('<option value="'+data[i].id+'" data-valor="'+data[i].value+'">'+data[i].name+'</option>');
                        }
                    });
                }, 500);
            };
        }         
        //Remover linhas da tabela de produtos
        function remover(data, valor){
            //console.log(data);
            $(data).parents('tr').remove();
            
            valorTotalNow = $('#vlTotal').val();
            setValueTotal(valorTotalNow - valor);
            //setValueTotal(getmemoryBeforeDesconto());

            $("#vlTotal").val(getValueTotal());
        } 
        //Irá pegar o valor atual do ultimo produto pesquisado
        function valorAtual(valor){
            this.lastProductValue = valor;
            //console.log('Last valor ' + this.lastProductValue);
            $('#vlTotal').append(valor);
        }
        //Listen Desconto
        function listenDesconto(){ 
            var desconto = document.getElementById('desconto');
            var timeout = null;
            desconto.onkeyup = function (e) {
                clearTimeout(timeout);
                timeout = setTimeout(function () {
                    if(!desconto.value == ''){
                        if((getValueTotal() - desconto.value) < 0){
                            alert('Valor desconto impossível');
                            setMemoryDesconto(0);
                            setValueTotal(getmemoryBeforeDesconto());
                        }else{
                            setMemoryDesconto(desconto.value);
                            setValueTotal(getValueTotal() - getMemoryDesconto());  
                        }
                        //$("#vlTotal").val(getValueTotal());  
                    }else{
                        //$("#vlTotal").val(getmemoryBeforeDesconto()); 
                    }   
                    $("#vlTotal").val(getValueTotal());  

                    setmemoryBeforeDesconto(getmemoryBeforeDesconto());
                    setValueTotal(getmemoryBeforeDesconto());
                }, 500);
            };
        }
    </script>
@endsection