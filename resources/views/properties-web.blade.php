@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Propiedades" :role="{{$rol}}" />
        </div>
        <div class="container">
            <properties-web :role="{{$rol}}"/>
        </div>

    </div>
@endsection
