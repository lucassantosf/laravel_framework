@extends('layout.app',["current"=>"home"])

@section('body')
	<div class="jumbotron bg-primary border border-dark">
		<div class="row">
			<div class="card-deck">
				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Cadastro de produtos</h5>
						<p class="card-text">
							Cadastro de todos os produtos comercializados pela empresa X Company LTDA
						</p>						
					</div>
					<div class="card-footer">
						<a href="/produtos/novo" class="btn btn-primary">Cadastrar</a>
					</div>
				</div>

				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Compras</h5>
						<p class="card-text">
							Registrar entrada em estoque para os produtos comercializados pela empresa X Company LTDA
						</p>
					</div>
					<div class="card-footer">
						<a href="/compras/novo" class="btn btn-primary">Comprar</a>
					</div>
				</div>

				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Vendas</h5>
						<p class="card-text">
							Realizar uma venda para um determinado produto
						</p>
					</div>
					<div class="card-footer">
						<a href="/vendas" class="btn btn-primary">Vender</a>
					</div>
				</div>

				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Relatórios</h5>
						<p class="card-text">
							Informações de todos os produtos comercializados pela empresa X Company LTDA
						</p>
					</div>
					<div class="card-footer bg-light">
						<a href="/relatorios" class="btn btn-primary">Visualizar</a>
					</div>
				</div>
			</div>

		</div>
	</div>
@endsection