@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
<<<<<<< HEAD
            <nav-admin :title="'Oportunidades'"/>
=======
            <nav-admin title="Oportunidades" />
>>>>>>> deee9bd50dbe7da7cbae6768cbe8c1850ae1a9e9
        </div>
        
        <oportunities 
            :users="{{$users}}" 
            :status="{{$status}}"
        />

    </div>
@endsection
