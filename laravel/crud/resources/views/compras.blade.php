@extends('layout.app',["current"=>"compras"])

@section('body')
	<div class="card border">
		<div class="card-body">
			<h5 class="card-title">Compras realizadas</h5>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>Id</th>
						<th>Produto da Compra</th>
						<th>Quantidade</th>
						<th>Ações</th>
					</tr>
				</thead>
				<tbody>
					@foreach($buys as $c)
					<tr>
						<td>{{$c->id}}</td>	
						<td>
							@foreach($prods as $p)
								@if($p->id == $c->produto_id)
									{{$p->nome}}
								@endif
							@endforeach
						</td>							
						<td>{{$c->qtd}}</td>	
						<td>
							<a href="/produtos/estornar/" class="btn btn-sm btn-danger">Estornar</a>
						</td>	
					</tr>
					@endforeach
				</tbody>
			</table>

		</div>
		<div class="card-footer">
			<a href="/compras/novo" class="btn btn-sm btn-primary">Registrar Compra</a>
		</div>
	</div>
@endsection