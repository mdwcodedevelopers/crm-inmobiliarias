@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Contactos'" :rol="{{$rol}}"/>
        </div>

        <contacts
        />

    </div>
@endsection
