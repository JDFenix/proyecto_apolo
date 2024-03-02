@extends('layouts.app')

@section('content')

<style>
    .btn-login {
    background-color: #022D74;
    width: 100%;
    color: white
}
</style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class=" text-white d-flex justify-content-center">
                    <img src="{{ asset('images/logo_universidad_vertical.png') }}" alt="Logo de la Universidad" class="mb-3">

                </div>

                <div class="d-flex justify-content-center">
                    <h5 class="card-title">¡Su registro fue exitoso!</h5>
                </div>

                <div class="d-flex justify-content-center">
                    <p>Ahora puede iniciar sesión en el sistema</p>
                </div>

                <div class="d-flex justify-content-center">
                    <a href="/" style="width:80%" class="btn btn-primary btn-login btn-custom btn_hover rounded-pill mt-3 ml-3">
                        Iniciar sesión
                    </a>
                </div>


            </div>
        </div>
    </div>
@endsection
