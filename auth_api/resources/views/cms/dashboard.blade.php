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
		                    <li class="breadcrumb-item active">
		                        Bem-vindo <strong>{{$auth->name}}</strong>!
		                    </li>
		                </ol>
		                <!-- breadcrumb -->
		            </div>
		        </div>
		    </div>
		    <!-- end row --> 
			
			@if($auth->role->id == 1 || $auth->role->id == 2) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
			<!-- listagem de usuários -->
			@if(count($usuarios)>0)
		    <div class="row">
		        <div class="col-xl-12">
		            <div class="card m-b-20">
		                <div class="card-body">
		                    <h4 class="mt-0 m-b-30 header-title">Usuários</h4>

		                    <div class="table-responsive">
			                        <table class="table table-vertical">
			                        	<thead>
										<tr>
				                            <th>USUÁRIO</th>
	                                        <th>TIPO</th>
	                                        <th>CRIADO EM</th>
	                                        @if($auth->role->id != 3) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
				                            <th>AÇÃO</th>
				                            @endif
			                            </tr>
		                        	</thead>
		                            <tbody>
	                            	@foreach($usuarios as $usuario)
		                            <tr>
		                                <td>
		                                    <img src="{{$usuario->image ? $usuario->image : 'https://via.placeholder.com/50x50'}}" alt="user-image" class="thumb-sm rounded-circle mr-2"/>
		                                    {{$usuario->name}}
		                                </td>
		                                <td><div class="badge badge-pill badge-secondary">{{$usuario->role->label}}</div></td>
		                                <td><div class="badge badge-pill badge-info">{{$usuario->created_at ? $usuario->created_at->diffForHumans() : 'Não foi atualizado!'}}</div>
		                                </td>
		                                @if($auth->role->id != 3) <!-- 1 = Administrador | 2 = Cliente | 3 = Conteudoria | 4 = Editor | 5 = Redator -->
		                                <td>
		                                    <form action="{{route('usuarios.destroy', $usuario->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="DELETE"/>

    										<div class="btn-group" role="group" aria-label="Basic example"
    										>
    											<a href="{{route('usuarios.edit', $usuario->id)}}" class="btn btn-primary"><i class="fas fa-edit"></i> Editar</a>
    										</div>
                                            </form>
		                                </td>
		                                @endif
		                            </tr>
		                            @endforeach
		                            </tbody>
		                        </table>
		                    </div>
		                </div>
		            </div>
		        </div>
			</div>
			@endif
			@endif
			<!-- end row -->
		</div> <!-- container-fluid -->
	</div>
</div>

@endsection

@section('script')
<!--Morris Chart-->
<script src="{{ URL::asset('assets/cms/pages/dashboard.js')}}"></script>
@endsection