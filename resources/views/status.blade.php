@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Estatus'" :role="{{$rol}}"/>
    </div>
    <div class="container">

        <status />
    </div>
@endsection
