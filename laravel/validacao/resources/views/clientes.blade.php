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
						<table class="table table-bordered table-hover" id="tabelaclientes">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nome</th>
									<th>Idade</th>
									<th>Email</th>
									<th>Endereço</th>
								</tr>
							</thead>
							<tbody>
								@foreach($cli as $c)
								<tr>
									<td>{{$c->id}}</td>
									<td>{{$c->nome}}</td>
									<td>{{$c->idade}}</td>
									<td>{{$c->email}}</td>
									<td>{{$c->endereco}}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>