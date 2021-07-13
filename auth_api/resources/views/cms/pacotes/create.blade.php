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

            <!-- Verifica e mostra erros dos campos obrigatórios -->
            @include('cms.includes.error_messages')

            <div class="row">
                <!-- Verifica e mostra mensagem de sucesso -->
                @include('cms.includes.alert_messages')
                <div class="col-12">
                    <div class="card m-b-20">
	                    <div class="card-body">
	                    	<form action="{{route('pacotes.store')}}" method="POST" enctype="multipart/form-data">
	                    		{{ csrf_field() }}

	                    		<div class="form-group row">
		                            <div class="col-md-12">
										<label for="descricao">Descrição</label>
	                                	<input class="form-control" type="text" name="descricao" value="{{old('descricao')}}" />
		                            </div>
		                        </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="especialidades">Especialidades</label>
                                        <input class="form-control" type="number" name="especialidades" value="{{old('especialidades')}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="perguntas">Perguntas</label>
                                        <input class="form-control" type="number" name="perguntas" value="{{old('perguntas')}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="trocas_especialidade">Trocas de especialidade permitidas</label>
                                        <input class="form-control" type="number" name="trocas_especialidade" value="{{old('descricao')}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="valor">Valor</label>
                                        <input class="form-control valor" type="string" name="valor" value="{{old('valor')}}"/>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="valor">Status</label>
                                        <select class="form-control" name="status">
                                            <option></option>
                                            <option value="0" @if(old('status') == 0) selected @endif >Inativo</option>
                                            <option value="1" @if(old('status') == 1) selected @endif >Ativo</option>
                                        </select>
                                    </div>
                                </div>

		                        <hr>

		                        <div class="form-group row">
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-primary btn-lg"><i class="fas fa-save"></i> Salvar alterações</button>
                                        <a href="{{route('pacotes.index')}}" class="btn btn-danger btn-lg"><i class="fas fa-window-close"></i> Cancelar</a>
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
    <script type="text/javascript">
        $(document).ready(function(){

            $('.valor').mask('#.##0,00', {reverse: true});

        });
    </script>
@endsection
