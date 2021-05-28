@extends('layouts.email')

@section('content')
    <h2 class="mb-5 text-primary">Hola, {{$contact_name}} te escribimos de parte de <strong>Daniel Canépa Inmobiliaria</strong> ya que tiene una oportunidad de {{$oportunity}} con nosotros!</h2>
    <p>{{$text}}</p>

@endsection

