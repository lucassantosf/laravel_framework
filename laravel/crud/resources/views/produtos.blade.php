@extends('layout.app',["current"=>"produtos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<h5 class="card-title">Cadastro de produtos</h5>
	@if(count($prods) > 0)
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
	<div class="card-footer">
		<a href="/produtos/novo" class="btn btn-sm btn-primary" role="button">Cadastrar produto</a>
	</div>
</div>
@endsection