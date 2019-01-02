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
							Clientes
						</div>	
					</div>

					<div class="card-body">
						<table id="tabelaclientes" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Código</th>
									<th>Nome</th>
									<th>Idade</th>
									<th>Endereço</th>
									<th>Email</th>
								</tr>
							</thead>
							<tbody>
								@foreach($clientes as $c)
									<tr>
										<td>{{$c->id}}</td>
										<td>{{$c->nome}}</td>
										<td>{{$c->idade}}</td>
										<td>{{$c->endereco}}</td>
										<td>{{$c->email}}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>

					<div class="card-footer">
						<a href="/novocliente" class="btn btn-primary btn-sm">Cadastrar</a>
					</div>

				</div>

			</div>
		</div>
	</main>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>