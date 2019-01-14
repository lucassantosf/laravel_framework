@extends('layouts.app',["current"=>"home"])

@section('body')
	<div class="jumbotron bg-light border border-secondary">
		<div class="row">
			<div class="card-deck">
				<div class="card border border-dark">
					<div class="card-body">
						<h5 class="card-title">Cadastro de produtos</h5>
						<p class="card-text">
							Aqui é um exemplo de texto
						</p>
					</div>
					<div class="card-footer">
						<a href="/produtos/novo" class="btn btn-dark">Cadastrar seus produtos</a>
					</div>
				</div>

				<div class="card border border-dark">
					<div class="card-body">
						<h5 class="card-title">Cadastro de categorias</h5>
						<p class="card-text">
							Aqui é um exemplo de texto
						</p>						
					</div>
					<div class="card-footer">
						<a href="/categorias/novo" class="btn btn-dark">Cadastrar categorias</a>
					</div>
				</div>

			</div>

		</div>
	</div>
@endsection