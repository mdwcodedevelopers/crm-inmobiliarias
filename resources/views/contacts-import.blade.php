@extends('layouts.app')

@section('content')
  <div>
    <div>
      <nav-admin :title="'Contactos'" :role="{{$role}}"/>
    </div>
    <div class="container">
      <contacts-import/>
    </div>
  </div>
@endsection
