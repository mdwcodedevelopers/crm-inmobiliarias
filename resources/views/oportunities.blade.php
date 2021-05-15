@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Oportunidades'" :role="{{$rol}}"/>
        </div>

        <oportunities
            :users="{{$users}}"
            :rol="{{$rol}}"
        />

    </div>
@endsection
