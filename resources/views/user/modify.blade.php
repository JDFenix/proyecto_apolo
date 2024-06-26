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

            .profile-edit {
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

        .btn-secondary {
            background: #6C757D;
        }

        .btn-secondary:hover {
            color: #6C757D;
            background: #FFFFFF;
            border-color: #6C757D;
        }

        .page-link {
            color: #000000;
        }

        .pagination .page-item.active .page-link {
            background-color: #052C65;
            border-color: #052C65;
        }

        .custom-input-matricula {
            width: 50%;
        }

        .custom-input-telefono {
            width: 70%;
        }

        .custom-input-sexo {
            width: 25%;
        }

        .custom-input-rol {
            width: 50%;
        }

        .custom-input-grado {
            width: 50%;
        }

        .custom-input-edad {
            width: 6%;
        }

        .mr-2 {
            margin-right: 12px;
        }
    </style>

    <div class="container mt-1">

        <div class="position-relative">
            <img src="{{ Auth::user()->image_cover }}" class="cover-photo mb-4">
            {{-- <button class="btn btn-primary edit-cover-button bi bi-pencil-square"> Editar Portada</button> --}}
            <img src="{{ Auth::user()->avatar }}" alt="Foto de perfil" class="profile-picture">
        </div>

        <!-- Nombre del alumno -->

        <div class="row mt-3">
            <div class="col-md-12">
                <h4 class="text-center profile-edit">Editar perfil</h4>
            </div>
        </div>

        <!-- Información del alumno -->

        <div class="row mt-3">
            <div class="col-md-40">
                <div class="p-3">
                    <form action="{{ route('user.update.post', Auth::user()->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                  
                        <input type="text" value="{{ Auth::user()->rol }}" name="rol" hidden>

                        @if (Auth::user()->rol == 'student')
                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre"
                                        value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="apellido-p">Apellido paterno:</label>
                                    <input type="text" class="form-control" id="apellido-p"
                                        value="{{ Auth::user()->paternal_surname }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="apellido-m">Apellido materno:</label>
                                    <input type="text" class="form-control" id="apellido-m"
                                        value="{{ Auth::user()->maternal_surname }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="carrera">Carrera:</label>
                                    <input type="text" class="form-control" id="carrera"
                                        value="{{ Auth::user()->student->career }}" disabled>
                                </div>

                                <div class="col">
                                    <label for="correo">Correo:</label>
                                    <input type="email" class="form-control" name="email" id="correo"
                                        value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" name="phone_number" class="form-control custom-input-telefono"
                                        id="telefono" value="{{ Auth::user()->phone_number }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="matricula">Matrícula:</label>
                                    <input type="text" class="form-control custom-input-matricula" id="matricula"
                                        value="{{ Auth::user()->student->enrollment }}" disabled>
                                </div>

                                <div class="col">
                                    <label for="grado" hidden>Grado:</label>
                                    <input type="text" class="form-control custom-input-grado" id="grado"
                                        value="" hidden disabled>
                                </div>

                                <div class="col">
                                    <label for="rol">Rol:</label>
                                    <input type="text" class="form-control custom-input-rol" id="rol"
                                        value="{{ __('roles.' . Auth::user()->rol) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="sexo">Sexo:</label>
                                    <input type="text" class="form-control custom-input-sexo" id="sexo"
                                        value="{{ __('sex.' . Auth::user()->sex) }}" disabled>
                                </div>
                            </div>
                        @else
                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="nombre">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre"
                                        value="{{ Auth::user()->name }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="apellido-p">Apellido paterno:</label>
                                    <input type="text" class="form-control" id="apellido-p"
                                        value="{{ Auth::user()->paternal_surname }}" disabled>
                                </div>
                                <div class="col">
                                    <label for="apellido-m">Apellido materno:</label>
                                    <input type="text" class="form-control" id="apellido-m"
                                        value="{{ Auth::user()->maternal_surname }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="carrera">Título profesional:</label>
                                    <input type="text" class="form-control" id="carrera"
                                        value="{{ Auth::user()->teacher->professional_title }}" disabled>
                                </div>

                                <div class="col">
                                    <label for="correo">Correo:</label>
                                    <input type="email" name="email" class="form-control" id="correo"
                                        value="{{ Auth::user()->email }}">
                                </div>

                                <div class="col">
                                    <label for="telefono">Teléfono:</label>
                                    <input type="tel" name="phone_number" class="form-control custom-input-telefono"
                                        id="telefono" value="{{ Auth::user()->phone_number }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="grado">Materia que imparte:</label>
                                    <input type="text" name="subjects_taught"
                                        class="form-control custom-input-materia" id="grado"
                                        value="{{ Auth::user()->teacher->subjects_taught }}">
                                </div>

                                <div class="col">
                                    <label for="matricula">Matrícula:</label>
                                    <input type="text" class="form-control custom-input-matricula" id="matricula"
                                        value="{{ Auth::user()->teacher->enrollment }}" disabled>
                                </div>

                                <div class="col">
                                    <label for="rol">Rol:</label>
                                    <input type="text" class="form-control custom-input-rol" id="rol"
                                        value="{{ __('roles.' . Auth::user()->rol) }}" disabled>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col mb-2">
                                    <label for="sexo">Sexo:</label>
                                    <input type="text" class="form-control custom-input-sexo" id="sexo"
                                        value="{{ __('sex.' . Auth::user()->sex) }}" disabled>
                                </div>

                                <div class="col mb-2">
                                    <label for="sexo">Cédula profesional:</label>
                                    <input type="text" class="form-control custom-input-cedula" id="sexo"
                                        value="{{ Auth::user()->teacher->license }}" disabled>
                                </div>


                                <div class="col mb-2">
                                </div>
                            </div>
                        @endif

                        
                        <button type="button" class="btn btn-secondary bi bi-arrow-left mt-2 mr-2"
                            data-bs-toggle="modal" data-bs-target="#deseas-regresar"> Cancelar </button>

                        <button type="button" class="btn btn-primary bi bi-floppy mt-2" data-bs-toggle="modal"
                            data-bs-target="#deseasGuardar"> Guardar </button>

                        <button type="submit" hidden id="confirm-form"></button>
                    </form>
                </div>
            </div>
        </div>

    </div>


    <div class="modal fade" id="deseasGuardar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered"> <!-- Modal centrado -->
            <div class="modal-content">

                <!-- Título del modal-->
                <div class="modal-header">
                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS GUARDAR LOS CAMBIOS? 💾
                    </h1>
                </div>

                <!-- Contenido del modal-->
                <div class="modal-body">
                    <p class="texto">Se han realizado cambios de datos del perfil.</p>
                </div>

                <!-- Footer del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('confirm-form').click()">Guardar</button>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="deseas-regresar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">

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

                    <form action="{{ route('user.perfil', ['id' => Auth::user()->id]) }}"
                        method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Abandonar</button>
                    </form>
                  
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
@endsection
