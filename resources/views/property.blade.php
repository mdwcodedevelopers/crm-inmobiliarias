@extends('layouts.app')

@section('content')

            @guest
                <div class="">
                    <nav-guest />
                </div>
            @else
                @if ($rol==1)
                    <div class="">
                        <nav-admin title="Propiedad" />
                    </div>
                @endif
                @if ($rol==2)
                    <div class="">
                        <nav-user />
                    </div>
                @endif
                @if ($rol==3)
                    <div class="">
                        <nav-agent>
                    </div>
                @endif
            @endguest
    <div class="">
            <property :property="{{$property}}"  />
    </div>
@endsection
