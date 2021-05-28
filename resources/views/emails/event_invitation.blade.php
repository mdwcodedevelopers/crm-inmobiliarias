@extends('layouts.email')

@section('content')
    <h2 class="mb-5 text-primary">¡Hola {{$contact_name}}, te escribimos de parte de <strong>Daniel Canépa Inmobiliaria!</strong></h2>

    <p>Has sido invitado a participar de un evento de <b>{{$type_event}}</b> el día {{$date}} con nuestro agente {{$agentName}} 
    el cual pronto le estará contactando, esperamos pueda acompañarnos.
    </p>
    <p>Esperamos tenga un buen día.</p>
@endsection

