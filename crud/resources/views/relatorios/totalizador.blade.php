@extends("../layout.app",["current"=>"relatorios"])

@section('body')
	@foreach($compras as $c)
		{{$c}}<br>
		@if(isset($c->compras))

			@foreach($c->compras->id)
				{{$c->compras->id}}<br>
			@endforeach

		@endif
	@endforeach
@endsection