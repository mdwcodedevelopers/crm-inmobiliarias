@extends('layouts.app')

@section('content')
    <div class="">
       
        @guest
        {{-- trabajar aca la parte gris --}}
            <div class="">
                <nav-guest />

            </div>
        @else
        <div class="">
            <nav-admin title="Home" :rol="{{$rol}}" />
        </div>
        @endguest
        <div style="text-align: center;" >
            <img src="/images/logo.png" alt="">
        </div>
        <div >
            <properties />

        </div>
    </div>
@endsection

