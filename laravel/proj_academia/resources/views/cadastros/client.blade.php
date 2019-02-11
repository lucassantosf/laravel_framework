@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Listagem de Clientes</div>

                <div class="card-body">
                    
                    @if(isset($clients))
                        @foreach($clients as $c)
                            <a href="/clients/{{$c->id}}/show" class="link">{{$c->name}}</a><br>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
