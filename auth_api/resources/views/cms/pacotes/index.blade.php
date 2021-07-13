@extends('layouts.cms_app')

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title">{{$title}}</h4>
                        <!-- breadcrumb -->
		                <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Painel</a></li>
                            <li class="breadcrumb-item"><a href="{{route('pacotes.index')}}">Pacotes</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
                        <div class="card-body">
                        	<table class="table table-striped mb-0">
	                        	<thead>
									<tr>
			                            <th>ID</th>
                                        <th>DESCRIÇÃO</th>
                                        <th>STATUS</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>

								<tbody>
                                @if(count($pacotes)>0)
    								@foreach($pacotes as $pacote)
    	                        	<tr>
    		                            <th scope="row">{{$pacote->id}}</th>
                                        <td>{{$pacote->descricao}}</td>
                                        <td>
                                            @if($pacote->status == 1)
                                                <span class="badge badge-success">Ativo</span>
                                            @else
                                                <span class="badge badge-danger">Inativo</span>
                                            @endif
                                        </td>
    		                            <td>
                                            <form action="{{route('pacotes.destroy', $pacote->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE" />

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('pacotes.edit', $pacote->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
    											<button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
    										</div>
                                            </form>
    		                            </div>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td>
                                           Não há pacotes cadastradas!
                                        </td>
                                    </tr>
                                @endif
		                        </tbody>
	                        </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    {{$pacotes->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection
