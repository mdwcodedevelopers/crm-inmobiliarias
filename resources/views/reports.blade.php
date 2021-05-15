@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Reportes'" :role="{{$role}}"/>
    </div>
    <div class="container">
        <reports/>
    </div>

@endsection
