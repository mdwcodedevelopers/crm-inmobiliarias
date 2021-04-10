@extends('layouts.app')

@section('content')
<<<<<<< HEAD
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
=======

        @if ($rol==1)
            <div class="">
                <nav-admin title="propiedad" />
            </div>
        @elseif ($rol==2)
            <div class="">
                <nav-agent />
            </div>
        @else
            <div class="">
                <nav-user>
            </div>
        @endif
    <div class="">
            <property :property="{{$property}}"  />
>>>>>>> 9936d23f9107233d22b261e78a959e61ca6abfac
    </div>
@endsection
