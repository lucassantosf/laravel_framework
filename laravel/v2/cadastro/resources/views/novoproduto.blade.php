@extends('layouts.app',["current"=>"produtos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<form action="/produtos" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeProduto">Nome</label>
				<input type="text" name="nomeProduto" id="nomeProduto
				" class="form-control" placeholder="Nome do produto">
				<label for="precoProduto">Preco</label>
				<input type="number" name="precoProduto" id="precoProduto
				" class="form-control" placeholder="Preco do produto">
				<label for="estoqueProduto">Estoque</label>
				<input type="number" name="estoqueProduto" id="estoqueProduto
				" class="form-control" placeholder="Estoque inicial">
				<div class="input-group mb-3" style="margin-top: 20px;">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="categoriaProduto">Categorias</label>
				  </div>
				  <select class="custom-select" id="categoriaProduto" name="categoriaProduto">
					@foreach($cats as $c)						
						<option value="{{$c->id}}">{{$c->nome}}</option>
					@endforeach				
				  </select>
				</div>
			</div>
			<div class="card-footer border">
				<button type="submit" class="btn btn-dark btn-sm">Salvar</button>
				<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
			</div>
		</form>
	</div>
</div>
@endsection