@extends('layouts.email')

@section('content')
    <h2  style="margin-bottom: 5rem; color: #1A237E !important;">¡Hola {{$contact_name}}, te escribimos de parte de <strong>Daniel Canépa Inmobiliaria!</strong></h2>

    <p>El evento de <b>{{$type_event}}</b> al cual has sido invitado ha sido pospuesto para el día {{$date}}, esperamos pueda acompañarnos.
    </p>
    <p>Que tenga un buen día.</p>
    
@endsection

