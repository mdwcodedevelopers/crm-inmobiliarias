@extends('layouts.app')

@section('content')

<div class="">
    <nav-admin :title="'Imagenes de la propiedad'"/>
</div>
    <div class="container">
            <image-propertie :property="{{$property}}" :id="{{$id}}" />
    </div>
@endsection
