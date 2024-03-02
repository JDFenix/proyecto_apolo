@extends('layouts.app')
@section('content')
    <style>
        p {
            top: 85%;
            left: 38%;
            position: absolute;
            color: #000;
            font-family: "Segoe UI";
            font-size: 24px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
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
            width: 25%;
            padding: 1%;
        }

        .card {
            width: 80%;
            height: 180%;
            transition: all 0.3s ease-in-out;
            left: 10%;
            border-radius: 24px;
        }

        .card:hover {
            transform: scale(1.04);
        }

        .circle-img {
            position: absolute;
            z-index: 1;
            width: 62%;
            left: 20%;
            top: 10%;
        }

        .role-img {
            position: relative;
            z-index: 2;
            width: 35%;
            left: 35%;
            top: 20%;
        }
    </style>

    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8 text-center">
                <h2 class="fw-bold mb-1 text-uppercase mt-5 mb-4">¿Cuál es tu rol?</h2>
                <div class="row">
                    <div class="col-md-6">
                        <a class="text-decoration-none text-dark" href="{{ route('student.register') }}">
                            <div class="card">
                                <img class="card-img-top circle-img" src="{{ asset('images/circle.png') }}" alt="circle">
                                <img class="card-img-top role-img" src="{{ asset('images/img-select-rol-student.png') }}"
                                    alt="Estudiante">

                                <div class="card-body">
                                    <p class="card-text">Estudiante</p>
                                </div>

                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a class="text-decoration-none text-dark" href="{{ route('teacher.validator') }}">
                            <div class="card">
                                <img class="card-img-top circle-img" src="{{ asset('images/circle.png') }}" alt="circle">
                                <img class="card-img-top role-img" src="{{ asset('images/img-select-rol-teacher.png') }}"
                                    alt="Estudiante">

                                <div class="card-body">
                                    <p class="card-text">Maestro</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div><br><br><br>
        <br>
        <br>
        <br>

        <div class="row">
            <div class="col-md-12 text-center"> <!-- Use col-md-12 and text-center to center the button -->
                <a href="{{route('login')}}"
                    class="btn btn-outline-primary btn_hover border-custom btn-whitout-border rounded-pill mt-4 mr-3 CustomTextColor">
                    <i class="fas fa-arrow-left"></i> Regresar
                </a>
            </div>
        </div>
    </div>
@endsection
