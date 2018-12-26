<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>
		Produtos
	</title>
</head>
<body>
	@hasSection('minha_secao')
	<div class="card">		
		<div class="card-body">
			<h5 class="card-title">Produtos</h5>
			<p class="card-text">
				@yield('minha_secao')				
			</p>
			<a href="#" class="card-link">Info</a>
			<a href="#" class="card-link">Ajuda</a>
		</div>
	</div>
	@endif
	
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>