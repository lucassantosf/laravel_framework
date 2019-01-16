@extends("../layout.app",["current"=>"compras"])

@section('body')
	<div class="card border">
		<div class="card-body">
			<form action="/compras/" method="POST">
				@csrf
				<div class="form-group">
					<label for="nomeProduto">Produto</label>
					<select class="custom-select" id="Produto" name="Produto">
						@foreach($prods as $p)						
							<option value="{{$p->id}}">{{$p->nome}}</option>
						@endforeach			
					</select>

					<label for="nomeProduto">Quantidade</label>
					<input class="form-control" type="text" name="qtdProduto" id="qtdProduto" placeholder="Quantidade">
						
					
				
				</div>

		</div>
		<div class="card-footer">
			<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
			<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
			
			</form>		<!-- Fim do formulário -->	
		</div>
	</div>
@endsection