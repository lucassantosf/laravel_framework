@extends('layout.meuLayout')

@section('minha_secao_produtos')
	@if (isset($palavra))
		Palavra: {{$palavra}}
	@endif
@endsection