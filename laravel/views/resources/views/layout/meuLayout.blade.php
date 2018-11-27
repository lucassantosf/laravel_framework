<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="{{URL::to('css/app.css')}}">
	<title></title>
</head>
<body>

	@hasSection('minha_secao_produtos')
	<div class="card">
		<div class="card-body">
			<h5 class="card-title" style="width: 500px; margin: 10px;">Produtos</h5>
			<p class="card-test">@yield('minha_secao_produtos')
			</p>
			<a href="#" class="card-link">Info</a>
			<a href="#" class="card-link">Ajuda</a>
		</div>
	</div>
	@endif
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>
</body>
</html>