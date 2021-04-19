@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Reportes'" :rol="{{$rol}}"/>
    </div>
    <div class="container">
        <reports/>
    </div>

@endsection
