@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Historial'" :rol="{{$role}}"/>
    </div>
    <div class="container">
        <historical/>
    </div>

@endsection
