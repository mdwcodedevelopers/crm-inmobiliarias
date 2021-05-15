@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Mis Eventos'" :role="{{$role}}"/>
        </div>

        <events :types="{{$events_types}}"
        />

    </div>
@endsection
