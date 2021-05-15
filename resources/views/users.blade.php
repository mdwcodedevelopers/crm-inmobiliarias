@extends('layouts.app')

@section('content')
    <div class="">
        <nav-admin title="Usuarios" :role="{{$rol}}" />
    </div>
    <div class="container">
        <users :role="{{$rol}}" />
    </div>

@endsection
