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
								<label for="nome">Nnome:</label>
								<input type="text" id="nome" class="form-control" name="nome" placeholder="Nome do cliente">
							</div>

							<div class="form-group">
								<label for="nome">Idade:</label>
								<input type="number" id="idade" class="form-control" name="idade" placeholder="Idade do cliente">
							</div>

							<div class="form-group">
								<label for="nome">Endereço:</label>
								<input type="text" id="endereco" class="form-control" name="endereco" placeholder="Endereço do cliente">
							</div>

							<div class="form-group">
								<label for="nome">Email:</label>
								<input type="text" id="emai" class="form-control" name="email" placeholder="Email do cliente">
							</div>

							<button type="submit" class="btn btn-primary btn-sm">Salvar</button>

							<button type="submit" class="btn btn-primary btn-sm">Cancelar</button>
						</form>
					</div>
				@if($errors->any())
					<div class="card-footer">
						@foreach($errors->all() as $error)
							<div class="alert alert-danger" role="alert">
								{{$error}}
							</div>
						@endforeach
					</div>
				@endif
				</div>
			</div>
		</div>
	</main>
	
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>