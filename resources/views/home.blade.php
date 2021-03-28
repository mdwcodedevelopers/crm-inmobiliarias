@extends('layouts.app')

@section('content')
    <div class="">
        @if ($rol==1)
        <div class="">
            <nav-admin />
        </div>
        @endif
        @if ($rol==2)
        <div class="">
            <nav-agent />
        </div>
        @endif
        <dashboard />
    </div>
@endsection
