@extends('layouts.app')

@section('content')
    <div>
       
        @guest
            <div class="grey lighten-2 d-flex justify-space-between align-md-center py-3 px-7  flex-column flex-sm-column  flex-md-row  " width="100%">
                <nav class="d-flex  align-start align-md-center ">
                    <ul class="m-0 p-0 d-flex" style="list-style: none">
                        <li class="elemento"><a href="#" class="black--text">Trabajá con nosotros</a></li>
                        <v-divider
                        class="mx-4"
                        inset
                        vertical
                    ></v-divider>
                        <li><a href="#" class="black--text">Institucional</a></li>
                    </ul>
                </nav>
                <div class="d-flex align-start align-md-center blue-grey--text font-weight-medium  flex-column flex-sm-column  flex-md-row mt-5 mt-lg-0 ">
                    <p class="m-0 mr-2">
                        Comunicáte con nosotros: <a href="https://api.whatsapp.com/send?phone=+542204823266" target="_blank">+54 220 482-3266</a> 
                    </p>
                    <p class="m-0">
                        Nuestras redes: 
                        <a href="https://facebook.com/inmobiliariadanielcanepa" target="_blank" class="blue-grey--text"><v-icon class="ml-2">mdi-facebook</v-icon></a>
                        <a href="https://instagram.com/inmobiliariadanielcanepa" target="_blank" class="blue-grey--text"><v-icon class="ml-2">mdi-instagram</v-icon></a>
                    </p>
                </div>
            </div>
            <div class="">
                <nav-guest />

            </div>
        @else
        <div class="">
            <nav-admin title="Home" :rol="{{$rol}}" />
        </div>
        @endguest
        <front-page></front-page>
    </div>
@endsection

