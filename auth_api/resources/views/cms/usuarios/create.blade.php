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
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Usuários</a></li>
                            <li class="breadcrumb-item active">{{$title}}</li>
		                </ol>
		                <!-- breadcrumb -->
                    </div>
                </div>
            </div> <!-- end row -->
            
            <!-- Verifica e mostra erros dos campos obrigatórios -->
            @include('cms.includes.error_messages')

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
	                    <div class="card-body">
	                    	<form action="{{route('usuarios.store')}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}
	                    		
                                <div class="form-group row">
                                    <div class="col-md-6"> <!-- <name> do usuário -->
                                        <label for="name">Nome</label>
                                        <input class="form-control" type="text" name="name" />
                                    </div>
                                    <div class="col-md-6"> <!-- <email> do usuário -->
                                        <label for="email">E-mail</label>
                                        <input class="form-control" type="text" name="email" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <tipo> do usuário -->
                                        <label for="role_id">Tipo de usuário</label>
                                        <select name="role_id" id="" class="form-control">
                                            <option value="">--</option>
                                            @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->label}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <small>
                                            <strong>Administrador</strong> = Acesso geral<br/>
                                            <strong>Cliente</strong> = Acesso geral<br/>
                                            <strong>Conteudoria</strong> = Acesso ao conteúdo geral<br/>
                                            <strong>Editor</strong> = Apenas conteúdo dos posts<br/>
                                            <strong>Redator</strong> = Apenas conteúdo das páginas
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-12"> <!-- <image> do perfil do usuário -->
                                        <label for="image">Foto</label>
                                        <input type="file" name="image" class="form-control" />
                                    </div>
                                </div>

                                <hr>

		                        <div class="form-group row">
                                    <div class="col-md-4"> <!-- <username> do usuário -->
                                        <label for="username">Nome de usuário</label>
                                        <input class="form-control" type="text" name="username" />
                                    </div>

                                    <div class="col-md-4"> <!-- <password> do usuário -->
                                        <label for="password">Senha</label>
                                        <input class="form-control" type="password" name="password" />
                                    </div>

                                    <div class="col-md-4"> <!-- <password_confirmation> do usuário -->
                                        <label for="password_confirmation">Confirmar senha</label>
                                        <input class="form-control" type="password" name="password_confirmation" />
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('usuarios.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
                                    </div>
		                        </div>
	                        </form>
	                    </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->        
        </div> <!-- container-fluid -->
    </div> <!-- content -->
</div>
@endsection

@section('scripts')
    @include('cms.includes.tinymce')
@endsection