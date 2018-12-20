@extends('layout.app',["current" => "home"])

@section('body')
	
	<div class="jumbotron bg-light border border-secondary">
		<div class="row">
			<div class="card-deck">
				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Cadastro de Produtos</h5>
						<p class="card-text">
							Aqui cadastra-se produtos
						</p>
						<a href="/produtos/novo" class="btn btn-primary">Cadastre seus produtos</a>
					</div>
				</div>
				
				<div class="card border border-primary">
					<div class="card-body">
						<h5 class="card-title">Cadastro de Categorias</h5>
						<p class="card-text">
							Aqui cadastra-se categorias
						</p>
						<a href="/categorias/novo" class="btn btn-primary">Cadastrar categorias</a>
					</div>
				</div>

			</div>
		</div>
	</div>

@endsection