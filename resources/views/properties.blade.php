@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
<<<<<<< HEAD
            <nav-admin title="Propiedades" />
=======
            <nav-admin :title="'Propiedades'"/>
>>>>>>> 6c32c95f672b728980ddb8fa2a03be55e3f8e6e1
        </div>
        <div class="container">
            <properties-user :rol="{{$rol}}"/>
        </div>

    </div>
@endsection
