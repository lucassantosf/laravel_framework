<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
	<title>
		Nome
	</title>
</head>
<body>

	@alerta(['tipo'=>'danger','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'warning','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'success','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'primary','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'secondary','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'info','titulo'=>'Erro fatal'])		
	@endalerta

	@alerta(['tipo'=>'dark','titulo'=>'Erro fatal'])		
	@endalerta

	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
</body>
</html>