@extends('layouts.app')

@section('content')
    @if ($rol == 0)
        <div class="">
            <nav-guest />
        </div>
    @endif
    @if ($rol == 1)
        <div class="">
            <nav-admin />
        </div>
    @endif
    @if ($rol == 2)
        <div class="">
            <nav-agent />
        </div>
    @endif
    @if ($rol == 3)
        <div class="">
            <nav-agent />
        </div>
    @endif
    <div class="">
        <propertie :property="{{ $property }}" />
    </div>
@endsection
