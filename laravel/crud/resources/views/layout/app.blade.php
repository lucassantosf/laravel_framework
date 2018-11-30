<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>Cadastro de Produto</title>
	<meta name="csrf-token" content="{{csrf_token()}}">
	<style type="text/css">
		body{
			padding: 20px;
		}
		.navbar{
			margin-bottom: 20px;
		}
	</style>
</head>
<body>

	<div class="container">
		@component('component_navbar',["current"=>$current])

		@endcomponent
		<main role="main">
			@hasSection('body')
				@yield('body')
			@endif
		</main>
	</div>

	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
</body>
</html>