@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin />
        </div>
        <properties-user :rol="{{$rol}}"/>

    </div>
@endsection
