@extends('layouts.app')

@section('content')
    <div class="">
        <nav-admin title="Usuarios" :role="{{$rol}}" />
    </div>
    <div class="d-flex">
        <nav-aside :role="{{$rol}}" ></nav-aside>
        <div class="main-desktop" >
            <div class="container">
                <users :rol="{{$rol}}" />
            </div>
        </div>
    </div>

@endsection
