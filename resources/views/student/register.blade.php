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

    <style>
        .color-letra {
            color: #022D74;
        }

        .texto {
            font-style: Segoe UI;
        }

        .btn-primary {
            color: #FFFFFF;
            background: #022D74;
            border: 2px solid;
            border-color: #022D74;
            transition: all 1s ease;
        }

        .btn-primary:hover {
            color: #022D74;
            background: #FFFFFF;
            border-color: #022D74;
        }

        .btn-secondary {
            background: #6C757D;
        }

        .btn-secondary:hover {
            color: #6C757D;
            background: #FFFFFF;
            border-color: #6C757D;
        }
    </style>




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
                                        <a class="dropdown-item nav-item nav-link" href="{{ route('user.contact') }}">
                                            <i class='fas fa-question-circle'></i>{{ __(' Ayuda') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>



                        @endguest
                        @guest
                            <a class="nav-item nav-link" href="{{ route('user.contact') }}">¿Necesitas ayuda?</a>
                        @endguest
                    </div>
                </div>
    </nav>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center mt-4">¡Crea tu cuenta!</h1>
                <form action="{{ route('register') }}" method="post" enctype="multipart/form-data" class="mx-auto">
                    @csrf
                    <input type="text" value="student" hidden name="rol">

                    <div class="form-group mt-5">
                        <label for="name">Nombre(s)*</label>
                        <input type="text" name="name" class="custom-input-teacher form-control" id="name"
                            {{--  value="{{ $name }}" readonly  --}}>
                    </div>

                    <div class="form-group mt-3">
                        <label for="paternal_surname">Apellido paterno*</label>
                        <input type="text" class="form-control custom-input-teacher" name="paternal_surname"
                            id="paternal_surname" {{--  value="{{ $paternal_surname }}" readonly  --}}>
                    </div>
                    <div class="form-group  mt-3">
                        <label for="maternal_surname">Apellido materno*</label>
                        <input type="text" class="form-control custom-input-teacher" name="maternal_surname"
                            id="maternal_surname" {{-- value="{{ $maternal_surname }}"  readonly  --}}>
                    </div>
                    <div class="form-group  mt-3">
                        <label for="date_birthday">fecha de nacimiento</label>
                        <input type="date" class="form-control custom-input-teacher" name="date_birthday"
                            id="">

                        <div class="form-group  mt-3">
                            <label for="email">correo</label>
                            <input type="email" class="form-control custom-input-teacher" name="email"
                                id="email">
                        </div>

                        <div class="form-group mt-3">
                            <label for="email">Carrera</label>
                            <select class="form-select form-select-lg mb-3 custom-input-teacher" name="career"
                                id="career" aria-label="Large select example">

                                <option selected value="Ingenieria en Software">Ingenieria en Software</option>
                                <option value="Ingenieria en informatica">Ingenieria en informatica</option>
                            </select>

                        </div>

                        {{-- <div class="form-group mt-3">
                            <label for="">Carrera</label>
                            <select name="" id="">
                                <option value=""></option>
                            </select>
                        </div> --}}

                        <div class="form-group  mt-3">
                            <label for="phone_number">Numero de telefono</label>
                            <input type="text" class="form-control custom-input-teacher-md " name="phone_number"
                                id="phone_number" </div>
                            <div class="form-group  mt-3">
                                <label for="age">Edad</label>
                                <input type="number" class="form-control custom-input-teacher" name="age"
                                    id="age"
                                    onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                            </div>

                            <div class="form-group mt-3">
                                <label for="sex">Sexo</label>
                                <select name="sex" class="form-select form-select-lg mb-3 custom-input-teacher"
                                    id="sex" aria-label="Large select example">
                                    <option selected value="men">Hombre </option>
                                    <option value="girl">Mujer</option>
                                </select>

                            </div>

                            <div class="form-group  mt-3 mb-5">
                                <label for="password">contraseña</label>
                                <input type="password" name="password" min="8" max="20"
                                    class="custom-input-teacher form-control" id="">
                            </div>
                            {{-- <button type="submit" class="btn  btn_hover btn-register-student btn-lg px-5 btnGran">
                                {{ __('Iniciar sesión') }}
                            </button> --}}
                            <div class="d-flex justify-content-center CustomTextColor mt-2 mb-4">
                                <button type="button"
                                    class=" btn-height btn  btn_hover border-custom btn-whitout-border rounded-pill mt-3 mr-3 CustomTextColor btn btn- "
                                    data-bs-toggle="modal" data-bs-target="#deseas-regresar">
                                    <i class="fas fa-arrow-left"></i> Regresar
                                </button>
                               
                                <button type="submit"
                                class="btn-height btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3"
                                data-bs-toggle="modal" data-bs-target="#deseasGuardar">
                                <i class="fa-regular fa-floppy-disk"></i> Guardar
                            </button>
                            </div>

                </form>
            </div>
        </div>
    </div>



    <div class="modal fade" id="deseas-regresar" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered"> <!-- Modal centrado -->
            <div class="modal-content">

                <!-- Título del modal-->
                <div class="modal-header">
                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS ABANDONAR? ⚠</h1>
                </div>

                <!-- Contenido del modal-->
                <div class="modal-body">
                    <p class="texto">Si abandonas la página, perderás los datos que hayas ingresado.</p>
                </div>

                <!-- Footer del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="window.location.href='/seleccionar/rol'">Abandonar</button>
                </div>

            </div>
        </div>
    </div>

    
<style>
    .texto-azul {
        font-style: Segoe UI;
        color: #022D74;
    }

    .p {
        Color: #000000
    }
</style>
<div class="container-fluid">

    <div class="row p-5 pb-2 bg-white texto-azul">

        <div class="col-xs-12 col-md-6 col-lg-3">
                <img src="{{ asset('images/logo_universidad.png') }}"  class="mb-2" width="160px" height="80px" src="./images/Logo horizontal.png"
                alt="Logo">
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <p class="h5 mb-4">Contáctanos</p>
            <div class="mb-2">
                <p class="bi bi-geo-alt-fill"><a class="text-secondary text-decoration-none"
                        href="https://www.google.com/maps/place/Universidad+Politecnica+de+Tecamac/@19.7141488,-98.9807546,17z/data=!3m1!4b1!4m6!3m5!1s0x85d1ed2fa5d3a6c1:0x1f383377175dc58a!8m2!3d19.7141438!4d-98.9781797!16s%2Fg%2F1q69rxsk0?entry=ttu">
                        Av. 5 de mayo, Tecámac Estado de México</a>
                    <p />
            </div>
            <div class="mb-2">
                <p class="bi bi-telephone-fill"> <a class="text-secondary text-decoration-none"
                        href="tel:+55235235634">
                        55235235634</a></p>
            </div>
            <div class="mb-2">
                <p class="bi bi-envelope-fill"><a class="text-secondary text-decoration-none"
                        href="https://mail.google.com/mail/?view=cm&fs=1&to=universidad@gmail.com">
                        universidad@gmail.com</a></p>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <p class="h5 mb-4">¿Nececitas ayuda?</p>
            <div class="mb-2">
                <p class="bi bi-info-circle-fill"><a class="text-secondary text-decoration-none"
                        href="{{ route('user.contact') }}"> Da
                        click aquí</a></p>
            </div>
        </div>

        <div class="col-xs-12 col-md-6 col-lg-3">
            <p class="h5 mb-4">Síguenos</p>
            <div class="mb-2">
                <p class="bi bi-facebook"><a class="text-secondary text-decoration-none"
                        href="https://www.facebook.com/"> Universidad Politécnica</a>
                </p>
            </div>
            <div class="mb-2">
                <p class="bi bi-instagram"><a class="text-secondary text-decoration-none"
                        href="https://www.instagram.com/"> @laU_Politécnica</a>
                </p>
            </div>
        </div>

        <div class="col-xs-12 pt-3 border-top">
            <p class="texto-azul text-center">Copyright - All rights reserved © 2024</p>
        </div>
    </div>
</div>