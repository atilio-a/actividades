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
@endsection

@section('content')

<p class="login-box-msg">Ingreso al Sistema</p>
<!-- Log on to marco farfan 3888-15568587 for more projects -->
@if (session('message'))
    
    <div class="alert alert-warning" role="alert">
        {{ session('message') }}
      </div>

@endif
<form action="{{ route('login') }}" method="post">
    @csrf
    <div class="form-group" style="width:400px;">

        <div class="input-group">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Email" value="{{ old('email') }}" required autocomplete="email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">

        <div class="input-group" style="width:400px;">
            <input type="password"   class="form-control @error('password') is-invalid @enderror" placeholder="Clave o Password"
                name="password" required autocomplete="current-password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="row">
        <div class="col-8">
            <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">
                    Recordarme
                </label>
            </div>
        </div>
        <!-- /.col -->
        <div class="col-8">
            <button type="submit" class="btn btn-success btn-block"> Ingresar al Sistema <i class="fa fa-share" aria-hidden="true"></i> </button>
        </div>
        <!-- /.col -->
    </div>
</form>

<!-- Brand Logo -->
<a href="{{route('home')}}" class="brand-link">
    <img src="{{ asset('images/logo.jpg') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
         style="max-height:90px;opacity: .8">
    
</a>
<!-- Log on to marco farfan 3888-15568587 for more projects -->


<a href="{{ route('register')}}" class="btn btn-primary btn-lg active px-3" role="button" aria-pressed="true"><i class="fas fa-users" aria-hidden="true"></i>Registrarse</a>
<!--a href="{{ route('password.request') }}" class="btn btn-secondary btn-lg active" role="button" aria-pressed="true">Olvidaste la clave?</a -->

@endsection