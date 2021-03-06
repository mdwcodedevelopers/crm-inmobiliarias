@extends('layouts.email')

@section('content')
    <h2 style="margin-bottom: 5rem; color: #1A237E !important;">Hola, {{$name}} gracias por registrarte en <strong>Inmobiliaria Daniel Canepa Propiedades</strong> !</h2>
    <p>Su contraseña de correo es <b>{{$confirmation_code}}</b>.</p>
    <p>Por favor confirme su correo electrónico en el siguiente enlace para poder acceder a la aplicación.</p>

    <a href="{{ url('/register/verify/'.$id .'/'. $confirmation_code) }}">
        Clic para confirmar tu email
    </a>
@endsection

