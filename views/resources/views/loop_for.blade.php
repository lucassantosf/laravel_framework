@extends('layouts.meulayout')

@section('minha_secao')
	
	<h5>Loop For</h5>
	
	<!--@for($i=0; $i<$n; $i++)

		{{$n}}
		<br>
	@endfor-->

	@foreach($produtos as $p)
		{{$p}}
	@endforeach
@endsection