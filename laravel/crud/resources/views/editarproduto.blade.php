@extends('layout.app',["current"=>"produtos"])

@section('body')
<div class="card-border">
	<div class="card-body">
		<form action="/produtos/{{$prod->id}}" method="POST">
			@csrf
			<div class="form-group">
				<label for="nomeCategoria">Nome do Produto</label>
				<input type="text" class="form-control" name="nomeProduto" value="{{$prod->nome}}" id="nomeProduto" placeholder="Nome do produto">
				<input type="text" class="form-control" name="estoqueProduto" value="{{$prod->estoque}}"  id="estoqueProduto" placeholder="Qtd estoque">
				<input type="text" class="form-control" name="precoProduto" value="{{$prod->preco}}" id="precoProduto" placeholder="Preco">
				
				<div class="input-group mb-3">  	
					
					<select class="form-control" name="categoria" value="{‌{ $prod->categoria_id }}">
					  @foreach($cats as $cat)
					      @if ($cat->id === $prod->categoria_id)
					<option selected value="{‌{ $cat->id }}">{‌{ $cat->nome  }}</option>
					      @else
					<option value="{‌{ $cat->id }}">{‌{ $cat->nome  }}</option>
					      @endif
					  @endforeach
					</select>		
					
				</div>		
			</div>	
			<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
			<a href="/produtos" class="btn btn-danger btn-sm">Cancelar</a>
		</form>
	</div>
</div>
@endsection