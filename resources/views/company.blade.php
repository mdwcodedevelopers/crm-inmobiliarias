@extends('layouts.app')

@section('content')

    <div class="">
        <nav-admin :title="'Empresa'"/>
    </div>
    <div class="">
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div style="width:80vw" >
                <company />
            </div>
        </div>
    </div>
@endsection
