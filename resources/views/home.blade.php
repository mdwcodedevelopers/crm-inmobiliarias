@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Home" :role="{{$rol}}"  />
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div style="width:80vw" >
                <dashboard />
            </div>
        </div>
    </div>
@endsection
