@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Mis Eventos'" :role="{{$role}}"/>
        </div>

        <events-invite :types="{{$events_types}}" :datas="{{$events}}" :role="{{$role}}"
        />

    </div>
@endsection
