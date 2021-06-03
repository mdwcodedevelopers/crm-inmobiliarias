@extends('layouts.email')

@section('content')
    <h2  style="margin-bottom: 5rem; color: #1A237E !important;">¡Hola {{$contact_name}}, te escribimos de parte de <strong>Daniel Canépa Inmobiliaria!</strong></h2>

    <p>{{$message}}</p>
    <p>Esperamos tengas un buen día.</p>
@endsection

