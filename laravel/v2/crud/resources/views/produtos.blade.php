@extends('layout.app',["current"=>"produtos"])

@section('body')
	<div class="card border">
		<div class="card-body">
			<h5 class="card-title">Cadastro de produtos</h5>
@if(count($prods) > 0)
			<table class="table table-hover">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nome</th>
						<th>Preco</th>
						<th>Quantidade</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($prods as $p)
					<tr>
						<td>{{$p->id}}</td>	
						<td>{{$p->nome}}</td>	
						<td>{{$p->preco}}</td>	
						<td>{{$p->estoque_minimo}}</td>	
						<td>
							<a href="/produtos/editar/{{$p->id}}" class="btn btn-sm btn-primary">Editar</a>
							<a href="/produtos/remover/{{$p->id}}" class="btn btn-sm btn-danger">Apagar</a>
						</td>	
					</tr>
					@endforeach
				</tbody>
			</table>
@endif
		</div>
		<div class="card-footer">
			<a href="/produtos/novo" class="btn btn-sm btn-primary">Cadastrar</a>
		</div>
	</div>
@endsection