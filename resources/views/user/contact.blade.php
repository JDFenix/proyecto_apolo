<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style.css">
    <link href="{{ asset('css/contact.css') }}" rel="stylesheet">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Contacto</title>
</head>

<body>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 60%;
            padding: 45px;
            border-radius: 0;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .row {
            box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;

        }

        .col-md-7 {
            padding: 20px;
        }

        .col-md-5 {
            background: #022D74;
            padding: 20px;
            color: white;

        }

        .form-control {
            height: 52px;
            background: #FFFFFF;
            color: #000000;
            font-size: 15px;
            border-radius: 2px;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .bi {
            font-size: 20px;
        }

        .d-flex p {
            font-size: 15px;
            padding-left: 10px;
            font-style: Segoe UI;
        }


        @media only screen and (max-width:600px) {
            .container {
                width: 100%;
                position: absolute;
                left: 50%;
                top: 90%;
            }
        }

        .btn-azul {
            color: #FFFFFF;
            background-color: #022D74;
        }

        .btn-azul:hover {
            color: #022D74;
            background-color: #FFFFFF;
            border-color: #022D74;
        }

        .color-borde {
            border-color: #022D74;
        }

        .requerido {
            color: red;
            display: inline;
        }
    </style>


    <nav class="navbar navbar-expand-lg navbar-white bg-white border-bottom mb-5">
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
            <form class="form-inline my-2 my-lg-0 mx-auto position-relative" style="left: 25%;">
                <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar"
                    style="width: 190%;background-color: #EBEBED; box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);border-radius:6px; height:20% !important">
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
                                        <a class=" dropdown-item nav-item nav-link" href="{{ route('user.perfil', ['id' => Auth::user()->id]) }}">
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
            </div>
        </div>
    </nav>

    <div class="container mt-5" style="top:55%">
        <div class="row">
            <div class="col-md-7">
                <h4>¿Tienes un problema?</h4>
                <p>Envíanos un mensaje...</p>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Nombre(s) <p class="requerido">*</p></label>
                    <input type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="Ingresa tu nombre" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Apellidos <p class="requerido">*</p></label>
                    <input type="text" class="form-control" id="formGroupExampleInput"
                        placeholder="Ingresa tus apellidos" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Email <p class="requerido">*</p></label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                        placeholder="Ingresa tu email" required>
                </div>
                <div class="mb-3">
                    <label for="formGroupExampleInput2" class="form-label">Número de teléfono <p class="requerido">*
                        </p>
                    </label>
                    <input type="text" class="form-control" id="formGroupExampleInput2"
                        placeholder="Ingresa tu número" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Describe tu problema <p
                            class="requerido">*</p></label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea>
                </div>
                <button class="btn btn-azul bi bi-send"> Enviar</button>
            </div>

            <!-- Contacto -->
            <div class="col-md-5">
                <h4>Contáctanos</h4>
                <hr>
                <div class="my-4">
                    <div class="d-flex">
                        <p class="bi bi-geo-alt-fill"><a class="text-white text-decoration-none"
                                href="https://www.google.com/maps/place/Universidad+Politecnica+de+Tecamac/@19.7141488,-98.9807546,17z/data=!3m1!4b1!4m6!3m5!1s0x85d1ed2fa5d3a6c1:0x1f383377175dc58a!8m2!3d19.7141438!4d-98.9781797!16s%2Fg%2F1q69rxsk0?entry=ttu">
                                Av. 5 de mayo, Tecámac Estado de México</a></p>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <div class="d-flex">
                        <p class="bi bi-telephone-fill"> <a class="text-white text-decoration-none"
                                href="tel:+55235235634">55235235634</a></p>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <div class="d-flex">
                        <p class="bi bi-envelope-fill"><a class="text-white text-decoration-none"
                                href="https://mail.google.com/mail/?view=cm&fs=1&to=universidad@gmail.com">
                                universidad@gmail.com</a></p>
                    </div>
                </div>
                <hr>
                <div class="my-4">
                    <div class="d-flex flex-column align-items-start">
                        <p class="h5 mb-4 text-center">Síguenos:</p>
                        <div class="mb-2">
                            <p class="bi bi-facebook"><a class="text-white text-decoration-none"
                                    href="https://www.facebook.com/"> Universidad Politécnica</a></p>
                        </div>
                        <div class="mb-2">
                            <p class="bi bi-instagram"><a class="text-white text-decoration-none"
                                    href="https://www.instagram.com/"> @laU_Politécnica</a></p>
                        </div>
                    </div>
                </div>
                <hr>
            </div>


        </div>
    </div>
    </div>

</body>

</html>
