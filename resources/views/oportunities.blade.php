@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin :title="'Oportunidades'" :rol="{{$rol}}"/>
        </div>

        <oportunities
            :users="{{$users}}"
            :rol="{{$rol}}"
        />

    </div>
@endsection
