@extends('layouts.app')

@section('content')

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
    </div>
@endsection
