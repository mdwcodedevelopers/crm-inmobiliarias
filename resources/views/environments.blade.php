@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Ambientes'" :role="{{$role}}"/>
    </div>
    <div class="container">
        <environments/>
    </div>

@endsection
