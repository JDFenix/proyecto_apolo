{{-- <div class="form-group">
    <label for="professional_title">Titulo Profesional</label>
    <input type="text" class="form-control custom-input" name="professional_title"
        id="professional_title">
</div>

<div class="form-group">
    <label for="license">Cedula</label>
    <input type="text" class="form-control custom-input" name="license" id="license"
        {{-- value="{{ $license }}" 
        readonly  --}}>
</div>


<div class="form-group">
    <label for="subjects_taught">Materias que imparte</label>
    <input type="text" class="form-control custom-input" name="subjects_taught"
        id="subjects_taught">
</div>
<div class="form-group">
    <label for="phone_number">Numero de telefono</label>
    <input type="number" class="form-control custom-input" name="phone_number" id="phone_number">
</div>
<div class="form-group">
    <label for="age">Edad</label>
    <input type="number" class="form-control custom-input" name="age" id="age">
</div>
<div class="form-group">
    <label for="sex">Sexo</label>
    <input type="text" class="form-control custom-input" name="sex" id="sex">
</div> --}}









{{-- @extends('layouts.app')


@section('content')

<style>
    
.custom-input {
    width: 486px;
    height: 48px;
    border-radius: 16px;
}

</style>

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-6">
            <h1 class="text-center">¡Crea tu cuenta!</h1>
            <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="text" hidden value="teacher" name="rol">

                    <div class="form-group">
                        <label for="name">Nombre*</label>
                        <input type="text" name="name" class="custom-input form-control" id="name" {{--  value="{{ $name }}"
                            readonly  --}}>
                    </div>
                    <div class="form-group">
                        <label for="paternal_surname">Apellido paterno*</label>
                        <input type="text" class="form-control" name="custom-input paternal_surname" id="paternal_surname"
                            {{--  value="{{ $paternal_surname }}" readonly  --}}>
                    </div>
                    <div class="form-group">
                        <label for="maternal_surname">Apellido materno*</label>
                        <input type="text" class="form-control" name=" custom-input maternal_surname" id="maternal_surname"
                            {{-- value="{{ $maternal_surname }}"  readonly  --}}>
                    </div>
                    <div class="form-group">
                        <label for="date_birthday">fecha de nacimiento</label>
                        <input type="date" class="form-control" name="date_birthday" id="">

                        <div class="form-group">
                            <label for="email">correo</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>
                        <div class="form-group">
                            <label for="professional_title">Titulo Profesional</label>
                            <input type="text" class="form-control" name="professional_title" id="professional_title">
                        </div>
                        
                        <div class="form-group">
                            <label for="license">Cedula</label>
                            <input type="text" class="form-control" name="license" id="license" {{-- value="{{ $license }}" 
                                readonly  --}}>
                        </div>


                        <div class="form-group">
                            <label for="subjects_taught">Materias que imparte</label>
                            <input type="text" class="form-control" name="subjects_taught" id="subjects_taught">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Numero de telefono</label>
                            <input type="number" class="form-control" name="phone_number" id="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="age">Edad</label>
                            <input type="number" class="form-control" name="age" id="age">
                        </div>
                        <div class="form-group">
                            <label for="sex">Sexo</label>
                            <input type="text" class="form-control" name="sex" id="sex">
                        </div>

                        <div class="form-group">
                            <label for="password">contraseña</label>
                            <input type="password" name="password" min="8" max="20" class="form-control"
                                id="">
                        </div>

                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <button type="button" class="btn btn-secondary">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
@endsection --}}
