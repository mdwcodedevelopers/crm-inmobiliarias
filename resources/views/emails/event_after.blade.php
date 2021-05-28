@extends('layouts.email')

@section('content')
    <h2 class="mb-5 text-primary">¡Hola {{$contact_name}}, te escribimos de parte de <strong>Daniel Canépa Inmobiliaria!</strong></h2>

    <p>{{$message}}</p>
    <p>Esperamos tengas un buen día.</p>
@endsection

