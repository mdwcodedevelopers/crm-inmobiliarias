@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Home" :role="{{$rol}}" />
        </div>
        <dashboard />
    </div>
@endsection
