@extends('layout.app', ["current" => "produtos" ])

@section('body')
<div class="card border">
    <div class="card-body">
        <h5 class="card-title">Cadastro de Produtos</h5>

        <table class="table table-ordered table-hover">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Preco</th>
                    <th>Departamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>  
                
                   
            </tbody>
        </table>      
    </div>
    <div class="card-footer">
        <button class="btn btn-sm btn-primary" role="button" onClick="novoProduto()">Novo produto</a>
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="dlgProdutos">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form class="form-horizontal" id="formProduto">
				<div class="modal-header">
					<h5 class="modal-title">Novo produto</h5>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" class="form-control">
					<div class="form-group">
						<label for="nomeProduto" class="control-label">Nome</label>
						<div class="input-group">
							<input type="text" class="form-control" id="nomeProduto" placeholder="Nome do produto">
						</div>
					</div>	

					<div class="form-group">
						<label for="precoProduto" class="control-label">Preco</label>
						<div class="input-group">
							<input type="number" class="form-control" id="precoProduto" placeholder="Preco">
						</div>
					</div>	

					<div class="form-group">
						<label for="qtdProduto" class="control-label">Quantidade</label>
						<div class="input-group">
							<input type="number" class="form-control" id="qtdProduto" placeholder="Quantidade">
						</div>
					</div>	

					<div class="form-group">
						<label for="categoriaProduto" class="control-label">Categoria</label>
						<div class="input-group">
							<select class="form-control" id="categoriaProduto">

							</select>
						</div>
					</div>	

				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
					<button type="cancel" class="btn btn-secondary" date-dissmiss="modal">Cancelar</button>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection
@section('javascript')
<script type="text/javascript">
	function novoProduto(){
		$('#id').val('');
		$('#nomeProduto').val('');
		$('#precoProduto').val('');
		$('#qtdProduto').val('');
		$('#dlgProdutos').modal('show');
	}

	function carregarCategorias(){
		$.getJSON('/api/categorias', function(data){
			console.log(data);
			for(i=0;i<data.length;i++){
				opcao = '<option value =" '+data[i].id + '">' + data[i].nome + '</option>';
				$('#categoriaProduto').append(opcao);
			}
		});
	}

	$(function(){
		carregarCategorias();
	})
</script>
@endsection