@extends('layouts.app')

@section('content')
    <style>
        .custom-input {
            width: 486px;
            height: 48px;
            border-radius: 16px;
        }




        .custom-input-advisory-disabled {
            background-color: #a7a7a75f;
        }


        .btn_hover:hover {
            background-color: #022D74;
            border-color: #022D74;
            color: white;
            transform: scale(1.02);
        }

        .border-custom {
            border: 4px solid #022D74;
        }

        .btn-whitout-border {
            width: 30%;
            padding: 3%;
        }

        .btn-custom {
            background-color: #022D74;
            color: white;
            border-color: #022D74;
            width: 30%;
            margin-left: 10%;
            padding: 2%;
            font-size: 20px;
        }

        .CustomTextColor {
            color: #022D74;
        }





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



        .btn-secondary {
            background: #6C757D;
        }

        .btn-secondary:hover {
            color: #6C757D;
            background: #FFFFFF;
            border-color: #6C757D;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1 class="text-center CustomTextColor ">Modificar asesoría</h1>
                <form action="{{ route('advisory.patch', $advisory->id) }}" method="post" enctype="multipart/form-data"
                    class="mx-auto">
                    @csrf
                    @method('PATCH')
                    <div style="margin-left:15%">

                        <div class="form-group mt-5 mb-4">
                            <label for="topic">Alumnos registrados:</label>
                            @foreach ($users as $user)
                                <li style="display: flex; align-items: center;" class="mb-2">
                                    {{ $user->name }} {{ $user->paternal_surname }} {{ $user->maternal_surname }}


                                    <button type="button"
                                        style="color: inherit; background:none; border:none; margin-left: 10px;"
                                        data-bs-toggle="modal" data-bs-target="#eliminar-alumno-modal-{{ $user->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <form
                                        action="{{ route('advisory.deleteUser', ['userId' => $user->id, 'advisoryId' => $advisory->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" hidden
                                            id="delete-button-student-{{ $user->id }}"></button>
                                    </form>

                                    <div class="modal fade" id="eliminar-alumno-modal-{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS
                                                        ELIMINAR AL ALUMNO? 🗑</h1>
                                                </div>

                                                <div class="modal-body">
                                                    <p class="texto">Si decides eliminar a este alumno, tendrás que pedirle
                                                        que se reinscriba. No podrás revertir esta acción.</p>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="document.getElementById('delete-button-student-{{ $user->id }}').click()">Eliminar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach






                            <div class="form-group ">
                                <label for="date">Fecha</label>
                                <input style="width:40%" type="date" name="date" class="custom-input form-control"
                                    id="date" value="{{ $advisory->date }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="time">Hora</label>
                                <input style="width:40%" type="time" class="custom-input form-control" name="time"
                                    id="time" value="{{ $advisory->time }}">
                            </div>

                            <div class="form-group mt-3">
                                <label for="subject">Materia</label>
                                <input style="width:83%" type="text"
                                    class="custom-input custom-input-advisory-disabled form-control" name="subject"
                                    id="subject" value="{{ $advisory->subject }}" readonly>
                            </div>

                            <div class="form-group mt-3">
                                <label for="topic">Tema de la asesoría</label>
                                <input value="{{ $advisory->tittle }}" style="width:83%" type="text"
                                    class="custom-input form-control" name="tittle" id="">
                            </div>


                        </div>
                        <div class="d-flex justify-content-center mt-2 mb-4 ">

                            <button type="button"
                                class=" btn-height btn  btn_hover border-custom btn-whitout-border rounded-pill mt-3 mr-3 CustomTextColor btn btn- "
                                data-bs-toggle="modal" data-bs-target="#deseasAbandonar-regresar">
                                <i class="fas fa-arrow-left"></i> Regresar
                            </button>
                            <button type="button"
                                class="btn-height btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3"
                                data-bs-toggle="modal" data-bs-target="#deseasGuardar">
                                <i class="fa-regular fa-floppy-disk"></i> Guardar
                            </button>
                        </div>
                        <button type="submit" id="send-form" hidden></button>
                </form>
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-start mt-5"
                style=" position: absolute; right: 0; top:10%">


                <button style="color: inherit; background:none; border:none" data-bs-toggle="modal"
                    data-bs-target="#deseasAbandonar">
                    <i class="fas fa-trash-alt fa-3x"></i>
                    <p class="mt-3 text-center">Cancelar asesoría</p>
                </button>
                <form action="{{ route('advisory.delete', ['id' => $advisory]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" hidden id="delete-advisory"></button>
                </form>

            </div>

        </div>
    </div>







    <div class="modal fade" id="deseasGuardar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered"> <!-- Modal centrado -->
            <div class="modal-content">

                <!-- Título del modal-->
                <div class="modal-header">
                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS GUARDAR LOS CAMBIOS? 💾</h1>
                </div>

                <!-- Contenido del modal-->
                <div class="modal-body">
                    <p class="texto">Se han realizado cambios de datos del perfil.</p>
                </div>

                <!-- Footer del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('send-form').click()">Guardar</button>
                </div>

            </div>
        </div>
    </div>



    <div class="modal fade" id="deseasAbandonar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        data-bs-backdrop="static">

        <div class="modal-dialog modal-dialog-centered"> <!-- Modal centrado -->
            <div class="modal-content">

                <!-- Título del modal-->
                <div class="modal-header">
                    <h1 class="modal-title fs-5 color-letra" id="exampleModalLabel">¿DESEAS ELIMINAR LA ASEOSRÍA? 🗑
                    </h1>
                </div>

                <!-- Contenido del modal-->
                <div class="modal-body">
                    <p class="texto">Si elimina la asesoría, no podrá revertir los cambios.</p>
                </div>

                <!-- Footer del modal-->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('delete-advisory').click()">Eliminar</button>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="deseasAbandonar-regresar" tabindex="-1" aria-labelledby="exampleModalLabel"
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
                        onclick="window.location.href='/inicio'">Abandonar</button>
                </div>

            </div>
        </div>
    </div>
@endsection
