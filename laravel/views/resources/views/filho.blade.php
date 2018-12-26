@extends('layouts.app')

@section('titulo','Herdeiro')

@section('barralateral')

	<p>Esta parte é do herdeiro</p>
	@parent
	
@endsection

@section('conteudo')
	<p>Este é o conteudo do herdeiro</p>
@endsection


