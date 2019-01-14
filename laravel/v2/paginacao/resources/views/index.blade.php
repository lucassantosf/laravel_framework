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
                
                <div class="card-header">Tabela de Clientes</div>
                <div class="card-body">
                    <h4 class="card-title">
                    Exibindo {{$clientes->count()}} clientes de {{$clientes->total()}} ({{$clientes->firstItem()}} a
                    {{$clientes->lastItem()}}) 
                    </h4>
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Sobrenome</th>
                            <th scope="col">Email</th>
                        </thead>
                        <tbody>
                        @foreach($clientes as $c)
                            <tr>
                                <td>{{$c->id}}</td>
                                <td>{{$c->nome}}</td>
                                <td>{{$c->sobrenome}}</td>
                                <td>{{$c->email}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$clientes->links()}}
                </div>
            </div>

        </div>

        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
    </body>
</html>
