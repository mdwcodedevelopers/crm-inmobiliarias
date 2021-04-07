@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
            <nav-admin title="Etiquetas" />
        </div>
        
       
         <tags
        :groups="{{$groups}}"
        :tags="{{$tags}}"
        />
        
    </div>
@endsection
