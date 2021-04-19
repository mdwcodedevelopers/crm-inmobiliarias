@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Home" :rol="{{$rol}}" />
        </div>
        <dashboard />
    </div>
@endsection
