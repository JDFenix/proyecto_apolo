<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/icon_page.png') }}" type="image/x-icon">
    <title>{{ env('app.name') }}</title>

</head>

<body class="">


    <div class="container-fluid">
        <div class="row">
            <!-- A la izquierda se encuentra una imagen -->
            <div class="col-md-6 p-0 colorBackImg">
                <img src="{{ asset('images/img-login.png') }}" alt="Imagen descriptiva" class="img-fluid w-100 vh-100">
            </div>
            <!-- A la derecha está el formulario -->
            <div class="col-md-6 d-flex align-items-center">
                <div class="container form-container">
                    <div class="d-flex justify-content-center mb-4">
                        <img src="{{ asset('images/logo_universidad.png') }}" style="width: 40%"
                            alt="Imagen descriptiva" class="img-fluid">
                    </div>
                    <h2 class="fw-bold mb-2 text-uppercase text-center CustomTextColor">Inicio de Sesión</h2>
                    <p class="text-dark-50 mb-5 text-center CustomTextColor">¡Comencemos a aprender!</p>

                    {{-- <div class="d-flex justify-content-start CustomTextColor">
                        <h2 class="fw-bold mb-2 text-uppercase">Inicio de Sesión</h2>
                        
                    </div>
                    <div class="d-flex justify-content-start CustomTextColor">
                        <p class="text-dark-50 mb-5">¡Comencemos a aprender!</p>
                    </div> --}}
                    <form method="POST" action="{{ route('login.post') }}">
                        @csrf
                        <div class="form-outline form-white mb-4">
                            <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus placeholder="Correo " />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-outline form-white mb-4">
                            <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Contraseña" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-login btn_hover btn-lg px-5 btnGran">
                            {{ __('Iniciar sesión') }}
                        </button>
                        {{-- <a style="width: 100%; margin-left:-0%" href="{{ route('user.index') }}"
                            class="btn-height btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3">
                            Iniciar sesión
                        </a>  --}}
                    </form>
                    <div class="text-center CustomTextColor mt-4">
                        {{-- <a href="{{ route('teacher.validator') }}"
                            class="text-decoration-none CustomTextColor mt-3">Regístrate
                            aquí</a> --}}
                        <a href="{{ route('user.selectRol') }}"
                            class="text-decoration-none CustomTextColor mt-3">Regístrate
                            aquí</a>
                        <span> | </span>
                        <a href="{{ route('forgetPassword') }}"
                            class="text-decoration-none CustomTextColor mt-3">¿Olvidaste tu
                            contraseña?</a>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</body>

</html>
