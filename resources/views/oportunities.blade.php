@extends('layouts.app')

@section('content')
    <div class="">
        <div class="">
<<<<<<< HEAD
            <nav-admin :title="'Oportunidades'"/>
=======
            <nav-admin title="Oportunidades" />
>>>>>>> 9936d23f9107233d22b261e78a959e61ca6abfac
        </div>

        <oportunities
            :users="{{$users}}"
            :status="{{$status}}"
            :rol="{{$user}}"
        />

    </div>
@endsection
