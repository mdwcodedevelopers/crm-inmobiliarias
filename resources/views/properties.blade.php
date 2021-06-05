@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Propiedades" :role="{{$rol}}" />
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div style="width:80vw" >
                <div class="container">
                    <properties-user :role="{{$rol}}"/>
                </div>
            </div>
        </div>

    </div>
@endsection
