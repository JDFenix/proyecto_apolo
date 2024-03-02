@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <h4 style="color:#022D74">FECHA</h4>
                <div class="card" style="width: 100%; max-width: 1376px; margin-right: 20px; border-radius:16px">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/icon_asesory_generic.png') }}" class=" img-fluid"
                                style="width: 9%; border-radius: 15%;">
                            <div class="ml-3" style="margin-left:1rem ">
                                <h5 class="card-title">Tema de la asesoría</h5>
                                <p class="card-text">Fecha y Hora de la asesoria</p>
                                <h6> Materia Nombre del profesor</h6>
                            </div>
                        </div>

                        @if (Auth::user()->rol == 'student')
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="#" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Inscribir
                            </a>
                        @else
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="{{ route('advisory.modify') }}" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Modificar
                            </a>
                        @endif

                    </div>
                </div>

                <div class="card mt-3" style="width: 100%; max-width: 1376px; margin-right: 20px; border-radius:16px">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/icon_asesory_generic.png') }}" class=" img-fluid"
                                style="width: 9%; border-radius: 15%;">
                            <div class="ml-3" style="margin-left:1rem ">
                                <h5 class="card-title">Tema de la asesoría</h5>
                                <p class="card-text">Fecha y Hora de la asesoria</p>
                                <h6> Materia Nombre del profesor</h6>
                            </div>
                        </div>


                        @if (Auth::user()->rol == 'student')
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="#" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Inscribir
                            </a>
                        @else
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="{{ route('advisory.modify') }}" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Modificar
                            </a>
                        @endif

                    </div>
                </div>

                <h4 style="color:#022D74" class="mt-4">FECHA</h4>
                <div class="card mt-2" style="width: 100%; max-width: 1376px; margin-right: 20px; border-radius:16px">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/icon_asesory_generic.png') }}" class=" img-fluid"
                                style="width: 9%; border-radius: 15%;">
                            <div class="ml-3" style="margin-left:1rem ">
                                <h5 class="card-title">Tema de la asesoría</h5>
                                <p class="card-text">Fecha y Hora de la asesoria</p>
                                <h6> Materia Nombre del profesor</h6>
                            </div>
                        </div>



                        @if (Auth::user()->rol == 'student')
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="#" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Inscribir
                            </a>
                        @else
                            <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">Status</h6>
                            <a href="{{ route('advisory.modify') }}" style="background-color: #022D74"
                                class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                Modificar
                            </a>
                        @endif

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('footer')
    @include('layouts.footer')
@endsection