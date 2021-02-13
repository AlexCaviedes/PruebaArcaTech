<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="description" content="Dashboard administrador Cootranshuila LTDA">
    <meta name="author" content="Cootranshuila Devs Team">

<link rel="icon" href="favicon.ico" type="image/x-icon"/>

<title>Ventas - Login</title>

<!-- Bootstrap Core and vandor -->
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" />

<!-- Core css -->
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/css/theme4.css') }}" id="stylesheet"/>

</head>
<body class="font-opensans">
<div class="auth">
    <div class="card">
        <style>
            .texto {
              font-family: Serif;
            }
          </style>
        <hr style="border: 1px solid #fff;">
        <br>
        <div class="text-center mb-5 px-5">
            <p class="title h1 texto" >Ventas Arca Tech</p>
        </div>
        <div class="card-body">
            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="card-title">Inicio de sesion</div>
                <div class="form-group style2">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" required name="email" placeholder="Ingrese su email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group style2">
                    <label class="form-label">Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" required name="password" placeholder="Ingrese su contraseña">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="custom-control-label">Recordarme</span>
                    </label>
                </div>
                <div class="form-footer">
                    <button type="submit" class="btn btn-success btn-lg btn-block" title="">Ingresar</button>
                </div>
            </form>

        </div>
        <hr style="border: 1px solid #fff;">
    </div>

</div>

<!-- jQuery and bootstrtap js -->
<script src="{{ asset('assets/bundles/lib.vendor.bundle.js') }}"></script>

<!-- start plugin js file  -->
<!-- Start core js and page js -->
<script src="{{ asset('assets/js/core.js') }}"></script>
</body>
</html>

