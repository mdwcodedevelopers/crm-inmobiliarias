@extends('layouts.app')

@section('content')

            @guest
                <div class="">
                    <nav-guest/>
                </div>
            @else
            <div class="">
                <nav-admin title="Propiedad {{$property->name}}" :role="{{$rol}}"  />
            </div>
            @endguest
            <div class="d-flex">
              <nav-aside :role="{{$rol}}" ></nav-aside>
              <div style="width:80vw" >
                  <div class="">
                    <property :property="{{$property}}"/>
                  </div>
              </div>
          </div>
@endsection
