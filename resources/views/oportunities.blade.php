@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Oportunidades'" :role="{{$rol}}"/>
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div class="main-desktop" >
                <oportunities
                    :users="{{$users}}"
                    :rol="{{$rol}}"
                />
            </div>
        </div>

    </div>
@endsection
