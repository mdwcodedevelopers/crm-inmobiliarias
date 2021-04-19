@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Propiedades" :rol="{{$rol}}" />
        </div>
        <div class="container">
            <properties-user :rol="{{$rol}}"/>
        </div>

    </div>
@endsection
