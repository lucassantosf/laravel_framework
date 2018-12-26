<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>
		Produtos
	</title>
</head>
<body>

	@if(isset($produtos))
		
		@if(count($produtos) == 0)
			<h1>Nenhum produto</h1>
		@elseif (count($produtos) === 1)
			<h1>Temos um produto</h1>
		@else
			<h1>Temos produtos</h1>
			@foreach($produtos as $prod)
				<h2>{{$prod}}</h2>
			@endforeach
		@endif

	@else
		<h1>Variavel de produtos não passado como parametro</h1>
	@endif

	@empty($produtos)
		<h1>Nada em produtos</h1>
	@endempty
	

	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>