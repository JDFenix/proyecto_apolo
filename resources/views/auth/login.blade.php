
@extends('layouts.app')

<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <div class="mb-md-5 mt-md-4 pb-5">

                            <h2 class="fw-bold mb-2 text-uppercase">Inicio de Sesión</h2>
                            <p class="text-white-50 mb-5">Ingresa su correo y contraseña!</p>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="typeEmailX" class="form-control form-control-lg"
                                        @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus />

                                    <label class="form-label" for="email">Correo</label>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="typePasswordX" class="form-control form-control-lg"
                                        @error('password') is-invalid @enderror" name="password" required
                                        autocomplete="current-password" />

                                    <label class="form-label" for="typePasswordX">Contraseña</label>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                    @if ($errors->first())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                </div>

                                <button type="submit" class="btn btn-outline-light btn-lg px-5">
                                    {{ __('Iniciar Sesión') }}
                                </button>
                            </form>
                            <br><br>


                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>