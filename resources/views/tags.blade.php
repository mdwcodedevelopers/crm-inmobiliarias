@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Etiquetas" :role="{{$rol}}"  />
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div class="main-desktop" >
                <tags
               />
            </div>
        </div>
       
        
    </div>
@endsection
