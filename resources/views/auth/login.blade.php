
<html lang="en">

<head> 

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="RNXDvdt5ep7rIJQ3hhK9rBgUhcbeGhJdAbtd5z2T">

    <title>login de usuario</title>

    <link rel="stylesheet" href="http://localhost:8000/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="http://localhost:8000/vendor/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="http://localhost:8000/vendor/adminlte/dist/css/adminlte.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="register-page" style="min-height: 457.995px;">

<div class="container register-box">
          
    <div class="register-box">

        <div class="card card-outline card-primary">
            <div class="card-header ">
                <h3 class="card-title float-none text-center">
                    ACCEDER</h3>
            </div>        
            <div class="card-body register-card-body ">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3">
                        <input type="email" id="email" value="{{ old('email') }}"  name="email" class="form-control @error('email') is-invalid @enderror"  value="" placeholder="Email" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope "></span>
                            </div>
                        </div>

                    </div>

                    <div class="input-group mb-3">
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" 
                        name="password" placeholder="Password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock "></span>
                            </div>
                        </div>

                    </div>


                    <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
    </div>

    <script src="http://localhost:8000/vendor/jquery/jquery.min.js"></script>
    <script src="http://localhost:8000/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="http://localhost:8000/vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="http://localhost:8000/vendor/adminlte/dist/js/adminlte.min.js"></script>
</body>

</html>