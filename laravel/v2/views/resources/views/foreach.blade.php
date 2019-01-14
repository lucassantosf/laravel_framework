
@extends('layouts.meulayout')

@section('minha_secao')

<h1>Loop Foreach</h1>

@foreach($produtos as $p)
	Produto: {{$p['id']}} - {{$p['nome']}}
	<br>
@endforeach

<hr>

@foreach($produtos as $p)
<p>

	Produto: {{$p['id']}} - {{$p['nome']}}
	@if($loop->first)
		(primeiro)
	@endif

	@if($loop->last)
		(ultimo)
	@endif

	<span class="badge badge-secondary">{{$loop->index}} / {{$loop->count -1}}
		/ {{$loop->remaining}} / {{$loop->iteration}}
	</span>
</p>
@endforeach

@endsection