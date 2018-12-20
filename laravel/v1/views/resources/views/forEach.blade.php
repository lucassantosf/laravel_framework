@extends('layout.meuLayout')

@section('minha_secao_produtos')

<h1>Loop Foreach - Arrays associativos</h1>

@foreach($produtos as $p)
	<p>{{$p['id']}}:{{$p['nome']}}</p>
@endforeach

<hr>

@foreach($produtos as $p)
	<p>

	{{$p['id']}}:{{$p['nome']}}
	
	@if($loop->first)
		(primeiro)
	@endif

	@if($loop->last)
		(ultimo)
	@endif
	<span class="badge badge-secondary">{{$loop->index}} / {{$loop->count-1}} / {{$loop->remaining}}</span>
	</p>

	<span class="badge badge-secondary">{{$loop->iteration}} / {{$loop->count}} </span>
	</p>
@endforeach

@endsection