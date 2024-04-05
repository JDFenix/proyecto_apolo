<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/js/app.js', 'resources/css/app.scss'])
    {{-- <link href="{{ asset('css/style.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <link rel="icon" href="{{ asset('images/icon_page.png') }}" type="image/x-icon">
    <title>Advisory</title>
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


            <form id="search-form" class="form-inline my-2 my-lg-0 mx-auto position-relative" style="left: 25%"
                action="{{ route('search') }}" method="GET">
                @csrf
                <input class="form-control mr-sm-2 mt-3" type="search" name="search" placeholder="Buscar" aria-label="Buscar"
                    style="width: 190%;background-color: #EBEBED; box-shadow: 0 2px 2px 0 rgba(0,0,0,0.16), 0 0 0 1px rgba(0,0,0,0.08);">
                <button type="submit" style="background: none; border:none">
                    <span class="fa fa-search form-control-feedback position-absolute"
                        style="right: 10px; top: 26px;left:175%"></span>
                </button>
            </form>

            <div id="search-results">
                <!-- Los resultados de la búsqueda se insertarán aquí -->
            </div>

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script>
                function performSearch() {
                    $.ajax({
                        url: $('#search-form').attr('action'),
                        method: 'GET',
                        data: $('#search-form').serialize(),
                        success: function(data) {
                            var html = '';
                            for (var i = 0; i < data.users.length; i++) {
                                html += '<p>' + data.users[i].name + '</p>';
                            }
                            $('#search-results').html(html);
                        }
                    });
                }
            </script>



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
                                        <form action="{{ route('user.perfil', ['id' => Auth::user()->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="dropdown-item nav-item nav-link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                                                </svg> {{ __('Perfil') }}
                                            </button>
                                        </form>

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
                                        <a class="dropdown-item nav-item nav-link" href="/contacto">
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

    <main class="py-4">
        @yield('content')
    </main>

    <main class="py-4">
        @yield('footer')
    </main>




    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>


    <script src="{{ mix('resources/js/app.js') }}" type="module"></script>

</body>

</html>
