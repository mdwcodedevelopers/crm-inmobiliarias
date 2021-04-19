@extends('layouts.app')

@section('content')
    <div class="">
        <nav-admin title="Usuarios" :rol="{{$rol}}" />
    </div>
    <div class="container">
        <users :rol="{{$rol}}" />
    </div>

@endsection
