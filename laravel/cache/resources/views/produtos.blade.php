<!DOCTYPE html>
<html>
<head>
	<title>Produtos</title>
	<style type="text/css">
		table{
			border-collapse: collapse;
		}
		table, th, td{
			border: 1px solic black;
		}
	</style>
</head>
<body>
	<table>
		<tr>
			<td>ID</td>
			<td>Nome</td>
			<td>Categorias</td>
		</tr>
		@foreach($produtos as $p)
			<tr>
				<td>{{$p->id}}</td>
				<td>{{$p->nome}}</td>
				<td>
					<ul>
						@foreaach($p->categorias as $c)
							<li>{{$c->nome}}</li>
						@endforeach
					</ul>
				</td>
			</tr>
		@endforeach
	</table>
</body>
</html>