@extends('layouts.app')

@section('content')
    <div class="">
        @if ($rol == 1)
            <div class="">
                <nav-admin :title="'Perfil'" />

            </div>
        @endif
        @if ($rol == 2)
            <div class="">
                <nav-user :title="'Perfil'" />
            </div>
        @endif
        @if ($rol == 3)
            <div class="">
                <nav-agent :title="'Perfil'" />
            </div>
        @endif
        <div class="container">
            <profile />
        </div>

    </div>
@endsection
