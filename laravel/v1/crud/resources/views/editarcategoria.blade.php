@extends('layout.app',["current"=>"categorias"])

@section('body')
	<div class="card border ">
		<div class="card-body">
			
			<form action="/categorias/{{$cat->id}}" method="POST">
				@csrf
				<div class="form-group">
					<label for="nomecategoria" >Nome:</label>
					<input type="text" class="form-control" name="nomecategoria" id="nomecategoria" value="{{$cat->nome}}" placeholder="Nome da categoria">
				</div>

				<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
				<a href="/" class="btn btn-danger btn-sm">Cancelar</a>
			</form>

		</div>
	</div>
@endsection