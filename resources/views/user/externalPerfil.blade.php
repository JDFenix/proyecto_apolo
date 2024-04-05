@extends('layouts.app')

@section('content')
    <style>
        .follow-icon {

            top: 100000px;

            right: 10px;

        }

        .custom-size-icon {
            font-size: 150%;

        }

        .button-follow {
            transition: transform 0.2s ease-in-out;
        }

        .button-follow:hover {
            transform: scale(1.2);
        }


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
            <img src="{{ $user->image_cover }}" class="cover-photo mb-4" alt="">
            {{-- <button class="btn btn-primary edit-cover-button bi bi-pencil-square"> Editar Portada</button> --}}
            <img src="{{ $user->avatar }}" alt="Foto de perfil" class="profile-picture">

        </div>


        <div class="row mt-3">
            <div class="col-md-12">
                <h4 class="text-center profile-name">{{ __('roles.' . $user->rol) }} {{ $user->name }}
                    {{ $user->paternal_surname }} {{ $user->maternal_surname }}</h4>
            </div>
        </div>

        <!-- Información del alumno -->

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="p-3">
                    <ul class="list-group list-group-flush">
                        @if ($user->rol == 'student')
                            <li class="list-group-item"><strong>Matrícula: </strong>{{ $user->student->enrollment }}
                            </li>
                            <li class="list-group-item"><strong>Correo: </strong>{{ $user->email }}</li>
                            <li class="list-group-item"><strong>Teléfono: </strong>{{ $user->phone_number }}</li>
                            <li class="list-group-item"><strong>Carrera: </strong>{{ $user->student->career }}</li>
                            <li class="list-group-item"><strong>Sexo: </strong>{{ __('sex.' . $user->sex) }}</li>
                            <li class="list-group-item"><strong>Rol: </strong>{{ __('roles.' . $user->rol) }}</li>

                            </li>
                        @endif
                        @if ($user->rol == 'teacher')
                            <li class="list-group-item"><strong>Matrícula: </strong>{{ $user->teacher->enrollment }}
                            </li>
                            <li class="list-group-item"><strong>Correo: </strong>{{ $user->email }}</li>
                            <li class="list-group-item"><strong>Teléfono: </strong>{{ $user->phone_number }}</li>
                            <li class="list-group-item"><strong>Titulo Profesional:
                                </strong>{{ $user->teacher->professional_tittle }}</li>
                            <li class="list-group-item"><strong>Materia que imparte:
                                </strong>{{ $user->teacher->subjects_taught }}</li>
                            <li class="list-group-item"><strong>Sexo: </strong>{{ __('sex.' . $user->sex) }}</li>
                            <li class="list-group-item"><strong>Rol: </strong>{{ __('roles.' . $user->rol) }}</li>
                        @endif
                    </ul>

                    {{-- <a class="btn btn-primary bi bi-pencil-square mt-2" href="{{ route('user.modify') }}"> Editar
                        perfil
                    </a> --}}
                </div>
            </div>

            <!-- Asesorias inscritas del alumno -->
            @if (Auth::user()->rol == 'student')
                <div class="col-md-8" style="position: absolute; margin-top:-2%">
                    <form action="{{ route('followUser', ['studentId' => Auth::user()->id, 'teacherId' => $user->id]) }}"
                        method="post">
                        @csrf
                        <button class="button-follow" type="submit" style="background: none; border:none;margin-left:15%;">
                            @if ($exists)
                                <i class="bi bi-patch-check-fill follow-icon custom-size-icon" style="left: -20%"></i>
                                <!-- Icono de paloma -->
                            @else
                                <i class="bi bi-patch-plus-fill follow-icon custom-size-icon" style="left: -20%"></i>
                                <!-- Icono normal -->
                            @endif
                        </button>
                    </form>
                </div>
            @endif

            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif



            @if (count($advisories) != 0)
                <div class="col-md-8">
                    @if ($user->rol == 'teacher')
                    <h5 class="mt-4">Asesorías impartidas</h5>
                    @else
                   
                    @endif
                    <div class="list-group mb-4">
                        @foreach ($advisories as $advisory)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $advisory->tittle }}</h5>
                                    <small>{{ $advisory->date }} {{ $advisory->time }}</small>
                                </div>
                                <small>{{ $advisory->subject }}</small>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                @if ($user->rol == 'teacher')
                    <div class="col-md-8">
                        <p>no hay asesorías creadas por este docente en este momento</p>

                    </div>
                @else
                    <div class="col-md-8">
                        <p>no hay asesorías a las que este alumno esté inscrito</p>
                    </div>
                @endif
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
