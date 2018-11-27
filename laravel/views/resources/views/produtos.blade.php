<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{URL::to('css/app.css')}}">
	<title></title>
</head>
<body>

	@if(isset($produtos))
		
		@if(count($produtos) == 0)
			<h1>Nenhum produto</h1>
		@elseif(count($produtos) === 1)
			<h1>Temos um produto</h1>
		@else
			<h1>Temos produtos</h1>
		@endif

		@foreach($produtos as $p)
			<p>Nome: {{$p}}</p>
		@endforeach

	@else
		<h1>Variavel não passada como param</h1>
	@endif

	@empty($produtos)
		<h2>NAda em produtos</h2>
	@endempty
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
</body>
</html>