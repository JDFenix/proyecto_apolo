@extends('layouts.app')

@section('content')
    <style>
        .cover-photo {
            height: 300px;
            width: 100%;
            background-image: url('https://via.placeholder.com/1500x300');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
            position: absolute;
            bottom: -75px;
            left: 20px;
            z-index: 1;
        }

        .edit-cover-button {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        /* CSS para cuando el tamaño de la pantalla es menor o igual a 768px */
        @media (max-width: 768px) {
            .position-relative {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .edit-cover-button {
                display: none;
                position: static;
                margin-top: 20px;
                /* Espacio entre el botón de editar y la foto de perfil */
            }

            .profile-name {
                text-align: center;
                margin-top: 70px;
            }
        }

        * {
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

        .page-link {
            color: #000000;
        }

        .pagination .page-item.active .page-link {
            background-color: #052C65;
            /* Cambia el color de fondo del enlace de página activo */
            border-color: #052C65;
            /* Cambia el color del borde del enlace de página activo */
        }
    </style>
    <div class="container mt-1">
        <div class="position-relative">
            <img src="#" class="cover-photo mb-4" alt="">

            <button class="btn btn-primary edit-cover-button bi bi-pencil-square"> Editar Portada</button>
            <img src="{{ Auth::user()->avatar }}" alt="Foto de perfil" class="profile-picture">
        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <h4 class="text-center profile-name">{{ __('roles.' . Auth::user()->rol) }} {{ Auth::user()->name }}
                    {{ Auth::user()->paternal_surname }} {{ Auth::user()->maternal_surname }}</h4>
            </div>
        </div>

        <!-- Información del alumno -->

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="p-3">
                    <ul class="list-group list-group-flush">
                        @if (Auth::user()->rol == 'student')
                            <li class="list-group-item"><strong>Matrícula: </strong>{{ Auth::user()->student->enrollment }}
                            </li>
                            <li class="list-group-item"><strong>Correo: </strong>{{ Auth::user()->email }}</li>
                            <li class="list-group-item"><strong>Teléfono: </strong>{{ Auth::user()->phone_number }}</li>
                            <li class="list-group-item"><strong>Carrera: </strong>{{ Auth::user()->student->career }}</li>
                            <li class="list-group-item"><strong>Sexo: </strong>{{ __('sex.' . Auth::user()->sex) }}</li>
                            <li class="list-group-item"><strong>Rol: </strong>{{ __('roles.' . Auth::user()->rol) }}</li>
                        
                            </li>
                        @endif
                        @if (Auth::user()->rol == 'teacher')
                            <li class="list-group-item"><strong>Matrícula: </strong>{{ Auth::user()->teacher->enrollment }}
                            </li>
                            <li class="list-group-item"><strong>Correo: </strong>{{ Auth::user()->email }}</li>
                            <li class="list-group-item"><strong>Teléfono: </strong>{{ Auth::user()->phone_number }}</li>
                            <li class="list-group-item"><strong>Titulo Profesional:
                                </strong>{{ Auth::user()->teacher->professional_tittle }}</li>
                            <li class="list-group-item"><strong>Materia que imparte:
                                </strong>{{ Auth::user()->teacher->subjects_taught }}</li>
                            <li class="list-group-item"><strong>Sexo: </strong>{{ __('sex.' . Auth::user()->sex) }}</li>
                            <li class="list-group-item"><strong>Rol: </strong>{{ __('roles.' . Auth::user()->rol) }}</li>
                        @endif
                    </ul>

                    <a class="btn btn-primary bi bi-pencil-square mt-2" href="{{ route('user.modify') }}"> Editar
                        perfil</a>
                </div>
            </div>

            <!-- Asesorias inscritas del alumno -->

            @if (Auth::user()->rol == 'student')
                <div class="col-md-8">
                    <h5 class="mt-4">Asesorías inscritas</h5>
                    <div class="list-group mb-4">
                        <a href="#" class="list-group-item list-group-item-primary active" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Tema de la asesoría</h5>
                                <small>Fecha y hora</small>
                            </div>
                            {{-- <p class="mb-1">Salón de la asesoría</p> --}}
                            <small>Nombre del profesor y materia</small>
                            {{-- <button class="btn btn-danger justify-content-end"
                                style="height: 2rem; padding:.2rem; margin-left:59.4%" data-bs-toggle="modal"
                                data-bs-target="#deseas-salir-asesoria">Salir de la asesoria</button> --}}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Tema de la asesoría</h5>
                                <small class="text-body-secondary">Fecha y hora</small>
                            </div>
                            {{-- <p class="mb-1">Salón de la asesoría</p> --}}
                            <small class="text-body-secondary">Nombre del profesor y materia</small>
                            {{-- <button class="btn btn-danger justify-content-end"
                                style="height: 2rem; padding:.2rem; margin-left:59.4%" data-bs-toggle="modal"
                                data-bs-target="#deseas-salir-asesoria">Salir de la asesoria</button> --}}
                        </a>
                        <a href="#" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">Tema de la asesoría</h5>
                                <small class="text-body-secondary">Fecha y hora</small>
                            </div>
                            {{-- <p class="mb-1">Salón de la asesoría</p> --}}
                            <small class="text-body-secondary">Nombre del profesor y materia</small>
                            {{-- <button class="btn btn-danger justify-content-end"
                                style="height: 2rem; padding:.2rem; margin-left:59.4%" data-bs-toggle="modal"
                                data-bs-target="#deseas-salir-asesoria">Salir de la asesoria</button> --}}
                        </a>
                    </div>

                    <!-- Barra de paginación -->
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <span class="page-link">Anterior</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">2</span>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Siguiente</a>
                            </li>
                        </ul>
                    </nav>
            @endif

            @if (Auth::user()->rol == 'teacher')
            <div class="col-md-8">
                <h5 class="mt-4">Asesorías impartidas</h5>
                <div class="list-group mb-4">
                    @foreach ($advisories as $advisory)
                    <a href="#" class="list-group-item list-group-item-primary active mt-1" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $advisory->tittle }}</h5>
                                <small>{{ $advisory->date }} {{ $advisory->time }}</small>
                            </div>
                            <small>{{ $advisory->subject }}</small>
                        </a>
                    @endforeach
                </div>
                {{-- {{ $advisories->links() }} --}}
            </div>
        @endif
        


        </div>
    </div>




    <div class="modal fade" id="deseas-salir-asesoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered"> <!-- Modal centrado -->
            <div class="modal-content">

                <!-- Título del modal-->
                <div class="modal-header">
                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS ABANDONAR LA ASESORIA? ⚠</h1>
                </div>

                <!-- Contenido del modal-->
                <div class="modal-body">
                    <p class="texto">Si abandonas la página, perderás los datos que hayas ingresado.</p>
                </div>

                <!-- Footer del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="window.location.href='/seleccionar/rol'">Abandonar</button>
                </div>

            </div>
        </div>
    </div>
@endsection
