@extends('layouts.app')

@section('content')
@guest
<div class="">
    <nav-guest />

</div>
@else
<div class="">
    <nav-admin />

</div>
@endguest
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <v-card color="blue">
                <p class="display-1 text-center mt-3 text-white">
                    Iniciar sesión
                  </p>
                <v-card>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <input id="email" type="email"  placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Correo o contraseña incorrecta</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mx-auto my-2">
                                <input  id="password" placeholder="Contraseña"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Contraseña incorrecta</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <v-btn type="submit" color="success">
                                    {{ __('Iniciar sesión') }}
                                </v-btn>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Olvidó su contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </v-card>
        </div>
    </div>
</div>
<front-footer></front-footer>  
@endsection
