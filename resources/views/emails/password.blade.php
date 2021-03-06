@extends('layouts.email')

@section('content')
    <h2  style="margin-bottom: 5rem; color: #1A237E !important;">Hola, {{$name}} tus datos han sido actualizados en <strong>Inmobiliaria Daniel Canepa Propiedades</strong> !</h2>
    <p>Su nueva contraseña de correo es <b>{{$confirmation_code}}</b>.</p>
    <p>Por favor confirme su correo electrónico en el siguiente enlace para poder acceder a la aplicación.</p>

    <a href="{{ url('/admin') }}">
        Clic acá para ir a la aplicación 
    </a>

@endsection
