@extends('layouts.app',["current"=>"produtos"])

@section('body')
<div class="card border">
	<div class="card-body">
		<form action="/produtos/{{$prod->id}}" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeProduto">Nome</label>
				<input type="text" name="nomeProduto" id="nomeProduto" value="{{$prod->nome}}" class="form-control">
				<label for="precoProduto">Preco</label>
				<input type="float" name="precoProduto" id="precoProduto" value="{{$prod->preco}}" class="form-control">
				<label for="estoqueProduto">Estoque</label>
				<input type="number" name="estoqueProduto" id="estoqueProduto" value="{{$prod->estoque}}" class="form-control" placeholder="Estoque inicial">
				<div class="input-group mb-3" style="margin-top: 20px;">
				  <div class="input-group-prepend">
				    <label class="input-group-text" for="categoriaProduto">Categoria</label>
				  </div>
				  <select class="custom-select" id="categoriaProduto" name="categoriaProduto">
						@foreach($cats as $c)		
							@if($c->id == $prod->categoria_id) 
								<option selected value="{{$c->id}}">{{$c->nome}}</option>
							@else
								<option value="{{$c->id}}">{{$c->nome}}</option>
							@endif 				
						@endforeach	
				  </select>
				</div>
			</div>
			<div class="card-footer border">
				<button type="submit" class="btn btn-dark btn-sm">Salvar</button>
				<a href="/produtos" class="btn btn-danger btn-sm">Cancelar</a>
			</div>
		</form>
	</div>
</div>
@endsection