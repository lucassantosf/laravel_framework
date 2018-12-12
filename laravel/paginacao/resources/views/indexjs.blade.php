<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <title>Paginacao</title>

        <!-- Fonts -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            body{
                padding: 20px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="card text-center">
                    
                <div class="card-header">
                    Tabela de Clientes
                </div>
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <table class="table table-hover" id="tabelaClientes">
                        <thead class="">
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col">Email</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>nome}}</td>
                                <td>sobrenome}}</td>
                                <td>email}}</td>
                            </tr> 
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    
                </div>

            </div>
        </div>
        <script type="text/javascript" src="{{asset('js/app.js')}}">
            
        </script>
        <script type="text/javascript">

            function montarLinha(cliente){
                return '<tr>'+
                    '<td>'+cliente.id+'</td>'+
                    '<td>'+cliente.nome+'</td>'+
                    '<td>'+cliente.sobrenome+'</td>'+
                    '<td>'+cliente.email+'</td>'+
                '</tr>';
            }

            function montarTabela(data){

                $("#tabelaClientes>tbody>tr").remove();
                for(i=0;i<data.data.length;i++){
                    s = montarLinha(data.data[i]);                    
                    $("#tabelaClientes>tbody").append(s);
                }
            }

            function carregarClientes(pagina){

                $.get('/json', {page: pagina}, function(resp){ 
                    montarTabela(resp);
                });
            }

            $(function(){
                carregarClientes(1);
            });
        </script>
    </body>
</html>
