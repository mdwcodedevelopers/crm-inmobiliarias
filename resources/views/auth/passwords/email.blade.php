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
                    Recuperar contraseña
                  </p>
                <v-card>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto mt-2">
                                <input id="email" type="email" placeholder="Correo" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 mx-auto">
                                <v-btn color="red" dark type="submit">
                                    {{ __('Enviar correo de recuperación') }}
                                </v-btn>
                            </div>
                        </div>
                    </form>
                </->
            </v-card>
        </div>
    </div>
</div>
@endsection
