<!DOCTYPE html>
<html>
<head>
	<title>Cadastrar Cliente</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<style type="text/css">
		body{
			padding-top: 20px;
		}
	</style>
</head>
<body>
	<main role="main">
		<div class="row">
				
			<div class="container col-sm-8 offset-md-2">
				<div class="card border">
					
					<div class="card-header">
						<div class="card-title">
							Cadastro de Cliente
						</div>	
					</div>
					<div class="card-body">
						<form action="/cliente" method="POST">
							@csrf
							<div class="form-group">
								<label for="nome">Nome do cliente</label>
								<input type="text" id="nome" 
									class="form-control {{$errors->has('nome') ? 'is-invalid':''}}" 
									name="nome" placeholder="Nome">
							@if($errors->has('nome'))
								<div class="invalid-feedback">
									{{$errors->first('nome')}}
								</div>
							@endif
							</div>	
							<div class="form-group">
								<label for="idade">Idade do cliente</label>
								<input type="number" id="idade" class="form-control {{$errors->has('idade') ? 'is-invalid':''}}"
								name="idade" placeholder="Idade">
							@if($errors->has('idade'))
								<div class="invalid-feedback">
									{{$errors->first('idade')}}
								</div>
							@endif
							</div>
							<div class="form-group">
								<label for="endereco">Endereço do cliente</label>
								<input type="text" id="endereco" class="form-control {{$errors->has('endereco') ? 'is-invalid':''}}"
								name="endereco" placeholder="Endereço">
							@if($errors->has('endereco'))
								<div class="invalid-feedback">
									{{$errors->first('endereco')}}
								</div>
							@endif
							</div>
							<div class="form-group">
								<label for="email">Email do cliente</label>
								<input type="text" id="email" class="form-control {{$errors->has('email') ? 'is-invalid':''}}"
								name="email" placeholder="Email">
							@if($errors->has('email'))
								<div class="invalid-feedback">
									{{$errors->first('email')}}
								</div>
							@endif
							</div>	
							<button type="submit" class="btn btn-primary btn-sm">Salvar</button>	
							<a href="/" class="btn btn-primary btn-sm">Cancelar</a>
						</form>
					</div>
					<!--
					@if($errors->any())
					<div class="card-footer">
						@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
								{{$error}}
							</div>
						@endforeach
					</div>
					@endif
					-->
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>