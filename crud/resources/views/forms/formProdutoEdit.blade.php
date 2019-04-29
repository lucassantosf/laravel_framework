@extends("../layout.app",["current"=>"produtos"])

@section('body')
	<div class="card border">
		<div class="card-body">
			<form action="/produtos/{{$prod->id}}" method="POST">
				@csrf
				<div class="form-group">
					<label for="nomeProduto">Nome do produto</label>
					<input class="form-control" type="text" name="nomeProduto" id="nomeProduto" placeholder="Descrição" value="{{$prod->nome}}">

					<label for="nomeProduto">Preço</label>
					<input class="form-control" type="text" name="precoProduto" id="precoProduto" placeholder="R$" value="{{$prod->preco}}">

					<label for="nomeProduto">Quantidade mínima</label>
					<input class="form-control" type="text" name="qtdProduto" id="qtdProduto" placeholder="Estoque" value="{{$prod->estoque_minimo}}">
				</div>

		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
			<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
			
			</form>		<!-- Fim do formulário -->	
		</div>
	</div>
@endsection