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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Painel</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Posts</a></li>
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
                                        <th>NOME</th>
                                        <th>TIPO</th>
                                        <th>CRIADO EM</th>
			                            <th>AÇÕES</th>
		                            </tr>
	                        	</thead>
							
								<tbody>
                                @if(count($usuarios)>0)
    								@foreach($usuarios as $usuario)
    	                        	<tr>
    		                            <th scope="row">{{$usuario->id}}</th>
                                        <td>{{$usuario->name}}</td>
                                        <td><div class="badge badge-pill badge-secondary">{{$usuario->role->label}}</div></td>
    		                            <td><div class="badge badge-pill badge-info">{{$usuario->created_at ? $usuario->created_at->diffForHumans() : 'Não foi atualizado!'}}</div></td>
    		                            <td>
                                            <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
                                                @if($auth->role_id == 1) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
    											<a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                <button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button>
                                                @elseif($auth->role_id == 2 && $usuario->role_id != 1)
                                                <a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
                                                @if($auth->id != $usuario->id)<button class="btn btn-danger"><i class="fas fa-trash"></i> Deletar</button> @endif
                                                @endif
    										</div>
                                            </form>
    		                            </td>
    		                        </tr>
    		                        @endforeach
                                @else
                                    <tr>
                                        <td>Não há usuários cadastrados!</td>
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
                    {{$usuarios->links()}}
                </div>
            </div>
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection