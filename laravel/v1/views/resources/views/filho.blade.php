@extends('layout.app')

@section('titulo', 'Herdeira')

@section('barralateral')
	@parent
	<p>Esta parte é do filho</p>
@endsection

@section('conteudo')
	<p>Este é o segundo conteudo</p>
@endsection
