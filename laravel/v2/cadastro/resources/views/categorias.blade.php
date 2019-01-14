@extends('layouts.app',["current"=>"categorias"])

@section('body')
<div class="card border">
@if(count($cats) > 0)
	<div class="card-body">
		<div class="card-title">Cadastro de Categorias</div>
		<table class="table table-ordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome da Categoria</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($cats as $c)
					<tr>
						<td>{{$c->id}}</td>
						<td>{{$c->nome}}</td>
						<td>
							<a href="/categorias/editar/{{$c->id}}" class="btn btn-dark btn-sm">Editar</a>
							<a href="/categorias/apagar/{{$c->id}}" class="btn btn-warning btn-sm">Apagar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@else
	<div class="card-body">
		Nenhuma categoria cadastrada
@endif	
		<div class="card-footer">
			<a href="/categorias/novo" class="btn btn-dark btn-sm">Cadastrar</a>
		</div>
	</div>
</div>
@endsection