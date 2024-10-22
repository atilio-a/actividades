@extends('layouts.auth')
@section('css')

    <style>
        .invalid-feedback {
            display: block
        }

        button {
            border-radius: 20px;
            border: 1px solid #FF4B2B;
            background-color: #FF4B2B;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: bold;
            padding: 12px 45px;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
        }
    </style>
@section('content')

    <p class="login-box-msg">Solicitud de cuenta de usuario</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group row">
            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

            <div class="col-md-6">
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                    name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

            <div class="col-md-6">
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                    name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Entidad') }}</label>

            <div class="col-md-6">
                <select name="entity_id" class="form-control" required>
                    <!-- Aquí debes cargar los departamentos desde tu base de datos -->
                    @foreach ($entities as $entity)
                        <option value="{{ $entity->id }}">{{ $entity->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="calle" class="col-md-4 col-form-label text-md-right">{{ __('Calle') }}</label>

            <div class="col-md-6">
                <input id="calle" type="text" class="form-control" name="calle" value="{{ old('calle') }}"
                    autocomplete="calle" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Numero') }}</label>

            <div class="col-md-6">
                <input id="numero" type="text" class="form-control" name="numero" value="{{ old('numero') }}"
                    autocomplete="numero" autofocus>
            </div>
        </div>
       
        <div class="form-group row">
            <label for="ciudad" class="col-md-4 col-form-label text-md-right">{{ __('Ciudad') }}</label>

            <div class="col-md-6">
                <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ old('ciuad') }}"
                    autocomplete="ciudad" autofocus>
            </div>
        </div>
       
       

        <div class="form-group row">
            <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>

            <div class="col-md-6">
                <input id="telefono" type="text" class="form-control" name="telefono"
                    value="{{ old('telefono') }}" autocomplete="telefono" autofocus>
            </div>
        </div>


       
        <div class="form-group row">
            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm"
                class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Registrar Usuario') }}
                </button>
            </div>
        </div>
    </form>

@endsection
