@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Historial'" :role="{{$role}}"/>
    </div>
    <div class="d-flex">
        <nav-aside :role="{{$role}}" ></nav-aside>
        <div class="main-desktop" >
            <div class="container">
                <historical/>
            </div>
        </div>
    </div>

@endsection
