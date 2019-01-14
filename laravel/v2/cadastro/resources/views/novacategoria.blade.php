@extends('layouts.app',["current"=>"categorias"])

@section('body')
<div class="card border">
	<div class="card-body">
		<form action="/categorias" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeCategoria">Nome</label>
				<input type="text" name="nomeCategoria" id="nomeCategoria
				" class="form-control" placeholder="Nome da categoria">
			</div>
			<div class="card-footer border">
				<button type="submit" class="btn btn-dark btn-sm">Salvar</button>
				<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
			</div>
		</form>
	</div>
</div>
@endsection