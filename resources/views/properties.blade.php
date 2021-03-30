@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Propiedades" />
        </div>
        <properties-user :rol="{{$rol}}"/>

    </div>
@endsection
