@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Reportes'" :role="{{$role}}"/>
    </div>
    <div class="d-flex">
        <nav-aside :role="{{$role}}" ></nav-aside>
        <div class="main-desktop" >
            <div class="container">
                <reports/>
            </div>
        </div>
    </div>

@endsection
