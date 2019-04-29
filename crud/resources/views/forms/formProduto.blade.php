@extends("../layout.app",["current"=>"produtos"])

@section('body')
	<div class="card border">
		<div class="card-body">
			<form action="/produtos" method="POST">
				@csrf
				<div class="form-group">
					<label for="nomeProduto">Nome do produto</label>
					<input class="form-control" type="text" name="nomeProduto" id="nomeProduto" placeholder="Descrição">

					<label for="nomeProduto">Preço</label>
					<input class="form-control" type="text" name="precoProduto" id="precoProduto" placeholder="R$">

					<label for="nomeProduto">Quantidade mínima</label>
					<input class="form-control" type="text" name="qtdProduto" id="qtdProduto" placeholder="Estoque">
				</div>

		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
			<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
			
			</form>		<!-- Fim do formulário -->	
		</div>
	</div>
@endsection