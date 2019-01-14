@extends('layouts.app',["current"=>"categorias"])

@section('body')
<div class="card border">
	<div class="card-body">
		<form action="/categorias/{{$cat->id}}" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeCategoria">Nome</label>
				<input type="text" name="nomeCategoria" id="nomeCategoria" value="{{$cat->nome}}" class="form-control" placeholder="Nome da categoria">
			</div>
			<div class="card-footer border">
				<button type="submit" class="btn btn-dark btn-sm">Concluir</button>
				<a href="/categorias" class="btn btn-warning btn-sm">Cancelar</a>
			</div>
		</form>
	</div>
</div>
@endsection