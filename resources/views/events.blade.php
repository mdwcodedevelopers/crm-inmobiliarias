@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Contactos'" :role="{{$rol}}"/>
        </div>

        <events
        />

    </div>
@endsection
