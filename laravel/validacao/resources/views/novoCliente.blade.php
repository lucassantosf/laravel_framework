<!DOCTYPE html>
<html>
<head>
	<title>Cadastro Clientes</title>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<meta name="csrf-token" content="{{csrf_token()}}">
	<style type="text/css">
		body{
			padding: 20px;
		}
	</style>
</head>
<body>
	<main role="main">
		<div class="row">
			<div class="container col-sm-8 offset-md-2">
				<div class="card border ">
					<div class="card-header">
						<div class="card-title">
							Cadastro de Cliente
						</div>
					</div>
					<div class="card-body">
						<form action="/cliente" method="POST">
							@csrf
							<div class="form-group">
								<label for="nome">Nome:</label>
								<input type="text" id="nome" class="form-control {{$errors->has('nome') ? 'is-invalid':''}}" name="nome" placeholder="Nome do cliente">
@if($errors->has('nome'))
								<div class="invalid-feedback">
	{{$errors->first('nome')}}
								</div>
@endif
							</div>

							<div class="form-group">
								<label for="nome">Idade:</label>
								<input type="number" id="idade" class="form-control {{$errors->has('idade') ? 'is-invalid':''}}" name="idade" placeholder="Idade do cliente">
@if($errors->has('idade'))
								<div class="invalid-feedback">
	{{$errors->first('idade')}}
								</div>
@endif
							</div>

							<div class="form-group">
								<label for="nome">Endereço:</label>
								<input type="text" id="endereco" class="form-control {{$errors->has('endereco') ? 'is-invalid':''}}" name="endereco" placeholder="Endereço do cliente">
@if($errors->has('endereco'))
								<div class="invalid-feedback">
	{{$errors->first('endereco')}}
								</div>
@endif
							</div>

							<div class="form-group">
								<label for="nome">Email:</label>
								<input type="text" id="email" class="form-control {{$errors->has('email') ? 'is-invalid':''}}" name="email" placeholder="Email do cliente">
@if($errors->has('email'))
								<div class="invalid-feedback">
	{{$errors->first('email')}}
								</div>
@endif
							</div>

							<button type="submit" class="btn btn-primary btn-sm">Salvar</button>

							<button type="submit" class="btn btn-primary btn-sm">Cancelar</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</main>
	
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>