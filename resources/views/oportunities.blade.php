@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Oportunidades'"/>
        </div>

        <oportunities
            :users="{{$users}}"
            :status="{{$status}}"
            :rol="{{$user}}"
        />

    </div>
@endsection
