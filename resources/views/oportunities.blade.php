@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Oportunidades" />
        </div>
        <oportunities :oportunities="{{$oportunities}}" />

    </div>
@endsection
