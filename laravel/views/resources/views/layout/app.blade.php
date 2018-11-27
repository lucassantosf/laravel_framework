<!DOCTYPE html>
<html>
<head>
	<title>Pagina PAI @yield('titulo')</title>
</head>
<body>
	@section('barralateral')
		Esta parte da seção é do template PAI
	@show
	<h1>Pagina PRINCIPAL</h1>
	<div>
		@yield('conteudo')
	</div>
</body>
</html>