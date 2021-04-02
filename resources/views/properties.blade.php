@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
<<<<<<< HEAD
            <nav-admin :title="'Propiedades'"/>
=======
            <nav-admin title="Propiedades" />
>>>>>>> deee9bd50dbe7da7cbae6768cbe8c1850ae1a9e9
        </div>
        <div class="container">
            <properties-user :rol="{{$rol}}"/>

        </div>

    </div>
@endsection
