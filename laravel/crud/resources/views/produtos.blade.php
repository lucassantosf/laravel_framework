@extends('layout.app',["current"=>"produtos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Cadstro de categorias</h5>
	@if(count($cats) > 0)
		<table class="table table-ordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome do Produto</th>
					<th>Estoque</th>
					<th>Preco</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
			@foreach($prods as $prod)
				<tr>
					<td>{{$prod->id}}</td>
					<td>{{$prod->nome}}</td>
					<td>{{$prod->estoque}}</td>
					<td>{{$prod->preco}}</td>
					<td>
						<a href="/produtos/editar/{{$prod->id}}" class="btn btn-sm btn-primary">Editar</a>
						<a href="/produtos/apagar/{{$prod->id}}" class="btn btn-sm btn-danger">Apagar</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	@endif
	</div>
</div>
@endsection