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
                    Registrarse
                  </p>
                <v-card>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto ">
                                <v-text-field id="name" label="Nombre" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="phone" label="Telefono" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required value="{{ old('phone') }}" >

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="province" label="Provincia" type="text" class="form-control @error('province') is-invalid @enderror" name="pronvince" value="{{ old('province') }}" >

                                @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="direction" label="Dirección" type="text" class="form-control @error('province') is-invalid @enderror" name="direction" value="{{ old('direction') }}" >

                                @error('direction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="email" label="Correo" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="password" label="Contraseña" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-6 mx-auto">
                                <v-text-field id="password-confirm" label="Confirmar contraseña" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <v-btn color="success" type="submit">
                                    {{ __('Registrarse') }}
                                </v-btn>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
