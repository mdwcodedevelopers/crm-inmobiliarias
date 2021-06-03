@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Estadisticas'" :role="{{$rol}}"/>
    </div>
    <div class="container">
        <analytics :users="{{$users}}" :favs="{{$favs}}"/>
    </div>
@endsection
