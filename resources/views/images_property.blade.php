@extends('layouts.app')

@section('content')

<div class="">
    <nav-admin />
</div>
    <div class="container">
            <image-propertie :property="{{$property}}" :id="{{$id}}" />
    </div>
@endsection
