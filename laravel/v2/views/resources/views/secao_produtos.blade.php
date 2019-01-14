@extends('layouts.meulayout')

@section('minha_secao')
	
	@if(isset($coisas))
		Palavra: {{$coisas}}
	@endif
	
@endsection