@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Contactos'" :role="{{$rol}}"/>
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div style="width:80vw" >
                <contacts
                />
            </div>
        </div>

    </div>
@endsection
