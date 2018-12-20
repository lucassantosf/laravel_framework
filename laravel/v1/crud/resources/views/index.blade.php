@extends('layout.app',["current"=>"home"])

@section('body')
	<div class="jumbotron bg-light border border-secondary">
		<div class="row">
			<div class="card-deck">
				
				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-tile">Cadastro de produtos</h5>
						<p class="card-text">
							Aqui é direcionado para o formulário de cadastro dos produtos
						</p>
						<a href="/produtos/novo" class="btn btn-primary">Cadastrar Produtos</a>						
					</div>
				</div>

				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-tile">Cadastro de categorias</h5>
						<p class="card-text">
							Aqui é direcionado para o formulário de cadastro das categorias
						</p>
						<a href="/categorias/novo" class="btn btn-primary">Cadastrar Categorias</a>						
					</div>
				</div>

			</div>

		</div>
	</div>
@endsection