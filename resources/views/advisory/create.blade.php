@extends('layouts.app')

@section('content')
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
    </style>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1 class="text-center CustomTextColor ">Agregar nueva asesoría</h1>
                <form action="{{ route('advisory.post') }}" method="post" enctype="multipart/form-data" class="mx-auto">
                    @csrf
                    <input type="text" hidden value="Activa" name="status">
                    <input type="text" hidden value="{{ Auth::user()->id }}" name="teachers_id">
                
                    <div style="margin-left:15%">
                        <div class="form-group mt-5">
                            <label for="date">Fecha*</label>
                            <input style="width:40%" type="date" name="date" class="custom-input form-control"
                                id="date">
                        </div>
                        @error('date')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="time">Hora*</label>
                            <input style="width:40%" type="time" class="custom-input form-control" name="time"
                                id="time">
                        </div>
                        @error('time')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="subject">Materia</label>
                            <input style="width:83%" type="text"
                                class="custom-input custom-input-advisory-disabled form-control" name="subject"
                                id="subject" value="{{ Auth::user()->teacher->subjects_taught }}" readonly>
                        </div>
                        @error('subject')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        <div class="form-group mt-3">
                            <label for="tittle">Tema de la asesoría*</label>
                            <input style="width:83%" type="text" class="custom-input form-control" name="tittle"
                                id="tittle">
                        </div>
                        @error('tittle')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                        @enderror

                        {{-- <div class="form-group mt-3 mb-3">
                            <label for="icon" class="mb-3">Agregar Icono</label>
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-radio mr-3">
                                    <input class="form-check-input" type="radio" name="icon" id="icon" checked>
                                    <label class="custom-control-label" for="icon">Sí</label>
                                </div>
                                <div style="margin-left:2rem" class="custom-control custom-radio">

                                    <input class="form-check-input" type="radio" name="icon" id="icon2">
                                    <label class="custom-control-label" for="icon2">No</label>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                    <div class="d-flex justify-content-center mt-2 mb-4 ">
                        <button type="button"
                            class=" btn-height btn  btn_hover border-custom btn-whitout-border rounded-pill mt-3 mr-3 CustomTextColor btn btn- "
                            data-bs-toggle="modal" data-bs-target="#deseasAbandonar-regresar">
                            <i class="fas fa-arrow-left"></i> Regresar
                        </button>
                        <button type="submit"
                            class="btn-height btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3" ">
                                               Guardar
                                            </button>

                                                </div>
                                            </form>
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
