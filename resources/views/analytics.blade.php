@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Estadisticas'" :role="{{$rol}}"/>
    </div>
    <div class="d-flex">
        <nav-aside :role="{{$rol}}" ></nav-aside>
        <div style="width:80vw" >
            <analytics :users="{{$users}}" :favs="{{$favs}}"/>
        </div>
    </div>
@endsection
