@extends('layouts.app')

@section('content')
    <div class="">
     
        @if ($rol==1)
        <div class="">
            <nav-admin title="Mi Empresa" :role="{{$rol}}"/>
        </div>
        <div class="d-flex">
            <nav-aside :role="{{$rol}}" ></nav-aside>
            <div class="main-desktop" >
                <configuration :rol="{{$rol}}" />
            </div>
        </div>
      
        @endif
        @if ($rol==2)
        <div class="">
            <nav-user />
            <h2>No tiene permisos para ver este módulo</h2>
        </div>
        @endif
        @if ($rol==3)
        <div class="">
            <nav-agent>
            <h2>No tiene permisos para ver este módulo</h2>
        </div>
        @endif
        <div >

        </div>
    </div>
@endsection
