@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Empresa'"/>
    </div>
    <div class="">
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div class="main-desktop" >
                <company />
            </div>
        </div>
    </div>
@endsection
