@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Mi perfil" :rol="{{$user->role_id}}" />
        </div>
        <div class="container">
            <profile :profile={{$user}} />
        </div>

    </div>
@endsection
