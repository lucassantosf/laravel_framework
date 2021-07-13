@extends('layouts.cms_login')

@section('content')
<!-- Begin page -->
<div class="wrapper-page">
    <div class="card">
        <div class="card-block">

            <div class="ex-page-content text-center">
                <h1 class="text-dark">401!</h1>
                <h4 class="">Você não tem permissão para acessar este conteúdo!</h4><br>

                <a class="btn btn-info mb-5 waves-effect waves-light" href="{{route('dashboard')}}"><i class="mdi mdi-home"></i> Voltar para o painel</a>
            </div>

        </div>
    </div>
</div>
@endsection