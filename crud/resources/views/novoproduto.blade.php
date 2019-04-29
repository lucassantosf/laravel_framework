@extends('layout.app',["current"=>"produtos"])

@section('body')
<div class="card-border">
	<div class="card-body">
		<form action="/produtos" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeProduto">Nome do Produto</label>
				
				<input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Nome do produto">
				<input type="text" class="form-control" name="estoqueProduto" id="estoqueProduto" placeholder="Qtd estoque">
				<input type="text" class="form-control" name="precoProduto" id="precoProduto" placeholder="Preco">
				
				<div class="input-group mb-3">
				  	
				<select class="custom-select" name="selectProdCat" id="selectProdCat">
				  	@foreach($cats as $cat)			
					   	
					   	<option value="{{$cat->id}}">{{$cat->id}}."-".{{$cat->nome}}</option>
							
					@endforeach
				</select>		

				</div>				

			</div>	
			<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
			<button type="submit" class="btn btn-danger btn-sm">Cancelar</button>
		</form>
	</div>
</div>
@endsection