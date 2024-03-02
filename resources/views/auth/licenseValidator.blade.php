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

        .custom-input-teacher-md {
            width: 110%;
            height: 48px;
            border-radius: 16px;
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

        .border-custom {
            border: 4px solid #022D74;
        }

        .btn-whitout-border {
            width: 30%;
            padding: 3%;
        }

        .btn_hover:hover {
            background-color: #022D74;
            border-color: #022D74;
            color: white;
            transform: scale(1.02);
        }
    </style>


    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">
                <h1 class="text-center CustomTextColor">Valida tu cedula!</h1>
                @if (isset($error))
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>
                @endif
                <form action="{{ route('validator') }}" method="post" enctype="multipart/form-data" class="mx-auto">
                    @csrf
                    <div class="form-group mt-5">
                        <label for="name">Nombre*</label>
                        <input type="text" name="name" class="custom-input-teacher-md form-control mb-4"
                            id="name" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="paternal_surname">Apellido paterno*</label>
                        <input type="text" class="custom-input-teacher-md form-control mb-4" name="paternal_surname"
                            id="paternal_surname" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="maternal_surname">Apellido materno*</label>
                        <input type="text" class="custom-input-teacher-md form-control mb-4" name="maternal_surname"
                            id="maternal_surname" oninput="this.value = this.value.toUpperCase()">
                    </div>
                    <div class="form-group">
                        <label for="license">Ingrese su cedula*</label>
                        <input type="text" class="custom-input-teacher-md form-control mb-3" name="license"
                            id="license"
                            onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                    </div>

                    <div class="d-flex justify-content-center CustomTextColor mt-2">
                        <button type="button"
                        class=" btn-height btn  btn_hover border-custom btn-whitout-border rounded-pill mt-3 mr-3 CustomTextColor btn btn- bi "
                        data-bs-toggle="modal" data-bs-target="#deseas-regresar">
                        <i class="fas fa-arrow-left"></i> Regresar
                    </button>
                     
                        <a style="padding:1rem" href="{{ route('teacher.register') }}"
                        class="btn-height btn btn-primary btn-custom btn_hover rounded-pill mt-3 ml-3">
                        Enviar
                    </a>
                    </div>

                    {{-- <button type="submit">VALIDAR</button> --}}
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
            <p class="h5 mb-4">¿Neceitas ayuda?</p>
            <div class="mb-2">
                <p class="bi bi-info-circle-fill"><a class="text-secondary text-decoration-none"
                        href="contacto.html"> Da
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
@endsection

