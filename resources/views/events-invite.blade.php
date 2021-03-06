@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Mis Eventos'" :role="{{$role}}"/>
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$role}}" ></nav-aside>
            <div class="main-desktop" >
                <events-invite :types="{{$events_types}}" :datas="{{$events}}" :role="{{$role}}"/>
            </div>
        </div>
        

    </div>
@endsection
