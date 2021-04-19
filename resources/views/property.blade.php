@extends('layouts.app')

@section('content')

            @guest
                <div class="">
                    <nav-guest />
                </div>
            @else
            <div class="">
                <nav-admin title="Propiedad {{$property->name}}" :rol="{{$rol}}" />
            </div>
            @endguest

  <div class="">
    <property :property="{{$property}}"  />
  </div>
@endsection
