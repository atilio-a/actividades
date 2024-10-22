<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('css')
</head>
<!-- #DACDC4,#5A6770    ---  #fffbf8,#faf2e7  b5aca3   ebecce   fffbf8   bbe9bf -->
<style>
.login-page{
        background:linear-gradient(-135deg,#0a95f8,#DACDC4);
    }

    .login-box{
        background:linear-gradient(-135deg,#faf2e7,#285b8f );
    }
    </style>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{route('home')}}" class="brand-link">
              
                <span class="brand-text font-weight-light">Actividades</span>
                <img src="{{ asset('images/logo.jpg') }}" alt="Magic" class="brand-image img-circle elevation-3"
                     style="max-height:60px;opacity: .8">
                  </a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                @yield('content')
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('js/app.js') }}"></script>

    @yield('js')

</body>

</html>