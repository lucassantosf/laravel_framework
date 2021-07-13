<!DOCTYPE html>
<html lang="pt-BR">
<head>
</head>

<body>
	@component('alert')
	    <strong>Whoops!</strong> Something went wrong!
	@endcomponent

	<h1>{{$name}} {{$title}}</h1>

	<p>A senha abaixo foi gerada:</p>

	<ul>
		<li>{{$password}}</li>
	</ul>

	<a href="{{route('dashboard')}}" class="btn btn-primary">Acessar painel</a>
	
</body>
</html>