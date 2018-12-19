<!DOCTYPE html>
<html>
<head>
	<title>pagina confirmacao</title>
</head>
<body>
	<h4>Seja Bem Vindo {{$nome}}</h4>

	<p>Você acabou de acessar o sistema utilizando seu email: {{$email}}</p>

	<p>Data/hora de acesso: {{$datahora}}</p>

	<p>Clique no link para confirmar seu email</p>

	<a href="{{$link}}">Clique Aqui</a>


</body>
</html>