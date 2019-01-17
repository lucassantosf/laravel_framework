@extends('./layout.app',["current"=>"cadastrar"])

@section('body')
		<div class="col-ms-6">
			<div class="card border">
				<div class="card-body">
					<h5>Cadastro de Contato</h5>
					<form method="POST" action="/contato/editar/{{$contact->id}}">
						@csrf
						<label for="">Nome</label>
						<input class="form-control" type="text" id="nome" name="nome" value="{{$contact->nome}}">

						<label for="emailContato">Email</label>
						<input class="form-control" type="email" id="email" name="email" value="{{$contact->email}}">

						<label for="ageContato">Idade</label>
						<input class="form-control" type="number" id="idade" name="idade" value="{{$contact->idade}}">

						<label for="telContato">Telefone</label>
						<input class="form-control" type="text" id="telefone" name="telefone" value="{{$contact->telefone}}">			

				</div>

				<div class="card-footer">
						<button type="submit" class="btn btn-primary btn-sm">Salvar</button>
						<button type="cancel" class="btn btn-danger btn-sm">Cancelar</button>
					</form>
				</div>

			</div>

		</div>	
@endsection