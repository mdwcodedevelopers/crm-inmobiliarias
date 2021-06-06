@extends('layouts.app')

@section('content')
  <div>
    <div>
      <nav-admin :title="'Contactos'" :role="{{$role}}"/>
    </div>
    <div class="d-flex">
      <nav-aside :role="{{$role}}" ></nav-aside>
      <div class="main-desktop" >
        <div class="container">
          <contacts-import/>
        </div>
      </div>
    </div>
  </div>
@endsection
