<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="{{ asset('images/icon_page.png') }}" type="image/x-icon">
    <title>{{ env('app.name') }}</title>

</head>

<body class="">
    
    <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom">
        @auth
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo_universidad.png') }}" width="140" height="53"
                    class="d-inline-block align-top " style="margin-left:20%" alt="logo">
            </a>
        @endauth

        @guest
            <a class="navbar-brand" href="{{ route('login') }}">
                <img src="{{ asset('images/logo_universidad.png') }}" width="140" height="53"
                    class="d-inline-block align-top " style="margin-left:20%" alt="logo">
            </a>
        @endguest
        @Auth
            <form class="form-inline my-2 my-lg-0 mx-auto position-relative" style="left: 25%">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar"
                    style="width: 190%;background-color: #EBEBED; box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);">
                <span class="fa fa-search form-control-feedback position-absolute"
                    style="right: 10px; top: 12px;left:175%"></span>
            </form>
        @endauth

        <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">



                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav ml-auto">
                        @guest

                            <a class="nav-item nav-link" href="{{ route('home') }}">Iniciar Sesión</a>
                        @else
                            <div class="dropdown" style="margin-left:-22rem">
                                <a class="nav-link dropdown-toggle d-flex align-items-center " href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ __('roles.' . Auth::user()->rol) }} {{ Auth::user()->name }}
                                    {{ Auth::user()->paternal_surname }}
                                    <img src="{{ Auth::user()->avatar }}" width=35px height=35px
                                        style='border-radius:50%; margin-left:5px; ;margin-top:-.5rem'>
                                </a>
                                <ul class="dropdown-menu" style="margin-left: 45%">

                                    <li>
                                        <a class=" dropdown-item nav-item nav-link" href="{{ route('user.perfil') }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                <path
                                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                            </svg> {{ __('Perfil') }}
                                        </a>
                                    </li>

                                    @if (Auth::user()->rol == 'teacher')
                                        <li>
                                            <a class=" dropdown-item nav-item nav-link mb-1"
                                                href="{{ route('advisory.create') }}">
                                                <i class='fas fa-edit'></i> {{ __('Crear Asesoria') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                                            <i class='fas fa-sign-out-alt' style="margin-left:-.4rem"></i>
                                            {{ __('Cerrar Sesión') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                    <li>
                                        <a class="dropdown-item nav-item nav-link" href="{{route('user.contact')}}">
                                            <i class='fas fa-question-circle'></i>{{ __(' Ayuda') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>



                        @endguest
                        @guest
                            <a class="nav-item nav-link" href="{{route('user.contact')}}">¿Necesitas ayuda?</a>
                        @endguest
                    </div>
                </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- A la izquierda se encuentra una imagen -->
            <div class="col-md-6 p-0">
                <img src="{{ asset('images/img_forgetPassword.png') }}"
                    style="height: 90% !important; width:90%;margin-left:18%" alt="Imagen descriptiva"
                    class="img-fluid">
            </div>
            <!-- A la derecha está el formulario -->
            <div class="col-md-6 d-flex align-items-center justify-content-center alignCustom">
                <!-- Cambiado a 'start' -->
                <div class="container form-container">
                    <h2 class="fw-bold mb-1 text-uppercase text-left CustomTextColor mb-4">¿Olvidaste tu contraseña?
                    </h2>
                    <p class="text-dark-50 mb-3 text-center mb-5"><strong>Ingrese su email </strong></p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-outline form-white mb-4">
                            <input type="email" id="typeEmailX" class="form-control form-control-sm custom-input"
                                @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
                                required autocomplete="email" autofocus placeholder="Correo " />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center CustomTextColor mt-2"> 
                            <a href="/" class="btn btn-outline-primary btn_hover border-custom btn-whitout-border rounded-pill mt-3 mr-3 CustomTextColor">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </a> 
                            <a href="{{route('recoverPassword')}}" class="btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3">
                                Enviar
                            </a>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
