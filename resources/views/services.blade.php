@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Servicios'" :role="{{ $role }}"/>
    </div>
    <div class="container">
        <services/>
    </div>

@endsection
