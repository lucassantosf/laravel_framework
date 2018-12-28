@extends('layouts.app',["current"=>"produtos"])

@section('body')
<div class="card border">
@if(count($prods) > 0)
	<div class="card-body">
		<div class="card-title">Cadastro de Produtos</div>
		<table class="table table-ordered table-hover">
			<thead>
				<tr>
					<th>Código</th>
					<th>Nome da Categoria</th>
					<th>Preco</th>
					<th>Estoque</th>
					<th>Categoria</th>
					<th>Ações</th>
				</tr>
			</thead>
			<tbody>
				@foreach($prods as $p)
					<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->nome}}</td>
						<td>{{$p->preco}}</td>
						<td>{{$p->estoque}}</td>
						<td>
							@foreach($cats as $c)
								@if($c->id == $p->categoria_id)
									{{$c->nome}}
								@endif
							@endforeach
						</td>
						<td>
							<a href="/produtos/editar/{{$p->id}}" class="btn btn-dark btn-sm">Editar</a>
							<a href="/produtos/apagar/{{$p->id}}" class="btn btn-warning btn-sm">Apagar</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
@else
	<div class="card-body">
		Nenhum produto cadastrado
@endif	
		<div class="card-footer">
			<a href="/produtos/novo" class="btn btn-dark btn-sm">Cadastrar</a>
		</div>
	</div>
</div>
@endsection