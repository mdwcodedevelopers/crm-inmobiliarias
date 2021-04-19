@extends('layouts.app')

@section('content')

<div class="">
    <nav-guest />

</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verificar email') }}</div>
                <div class="card-body">
                    
                    @if (!is_null($verificado))
                     {{$verificado}}   
                    @else
                    Su cuenta ha sido verificada con exito, para ingresar a la página haga clic acá
                    
                    @endif
                    <br>
                    <v-btn class="py-3" type="submit" color="success" href="{{ url('/admin')}}">
                        Ir a iniciar sesión
                    </v-btn>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
