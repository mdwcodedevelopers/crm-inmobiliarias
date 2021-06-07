@extends('layouts.app')

@section('content')

            @guest
                <div class="">
                    <nav-guest/>
                </div>
                <property :property="{{$property}}"/>

            @else
            <div class="">
                <nav-admin title="Propiedad {{$property->name}}" :role="{{$rol}}"  />
            </div>
            <div class="d-flex">
              <nav-aside :role="{{$rol}}" ></nav-aside>
              <div class="main-desktop" >
                  <div class="">
                    <property :property="{{$property}}"/>
                  </div>
              </div>
          </div>
            @endguest
@endsection
