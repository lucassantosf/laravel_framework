<!DOCTYPE html>
<html>
<head>
	<!--<link rel="stylesheet" href="{{asset('css/app.css')}}">-->
	<link rel="stylesheet" href="{{URL::to('css/app.css')}}">
	<title></title>
</head>
<body>

	@alerta(['tipo'=>'danger'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta

	@alerta(['tipo'=>'primary'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta

	@alerta(['tipo'=>'success'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta

	@alerta(['tipo'=>'secondary'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta

	@alerta(['tipo'=>'dark'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta

	@alerta(['tipo'=>'info'])
	<strong>Error</strong> Mensagem de erro
		@slot('titulo')
			Erro fatal
		@endslot		
	@endalerta
	
	<script src="{{asset('js/app.js')}}" type="text/javascript"></script>

</body>
</html>