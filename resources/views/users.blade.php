@extends('layouts.app')

@section('content')
    <div class="">
        <nav-admin title="Usuarios" :role="{{$rol}}" />
    </div>
    <div class="d-flex">
        <nav-aside :role="{{$rol}}" ></nav-aside>
        <div style="width:80vw" >
            <div class="container">
                <users :role="{{$rol}}" />
            </div>
        </div>
    </div>

@endsection
