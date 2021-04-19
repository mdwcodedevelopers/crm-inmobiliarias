@extends('layouts.app')

@section('content')
    <div class="">
       
        @guest
            <div class="">
                <nav-guest />

            </div>
        @else
        <div class="">
            <nav-admin title="Home" :rol="{{$rol}}" />
        </div>
        {{-- @endif
        @if ($rol==2)
        <div class="">
            <nav-user />
        </div>
        @endif
        @if ($rol==3)
        <div class="">
            <nav-agent>
        </div>
        @endif --}}
        @endguest
        <div style="text-align: center">
            <img src="/images/logo.png" alt="">
        </div>
        <div >
            <properties />

        </div>
    </div>
@endsection
