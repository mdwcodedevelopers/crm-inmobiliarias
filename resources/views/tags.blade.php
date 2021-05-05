@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Etiquetas" :rol="{{$rol}}"  />
        </div>
        
       
         <tags
        />
        
    </div>
@endsection
