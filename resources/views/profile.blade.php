@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Mi perfil" :role="{{$user->role_id}}" />
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$user->role_id}}" ></nav-aside>
            <div class="main-desktop" >
                <div class="container">
                    <profile :profile="{{$user}}" />
                </div>
            </div>
        </div>
    </div>
@endsection
