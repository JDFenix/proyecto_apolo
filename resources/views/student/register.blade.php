@extends('layouts.app')

<h1>reistro alumno</h1>

<form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="text" hidden value="student" name="rol">

    <label for="name">nombre</label>
    <input type="text" name="name" id=""><br><br>

    <label for="name">apellido paterno</label>
    <input type="text" name="paternal_surname" id=""><br><br>

    <label for="name">apellido materno</label>
    <input type="text" name="maternal_surname" id=""><br><br>

    <label for="date_birthday">fecha de nacimiento</label>
    <input type="date" name="date_birthday" id=""><br><br>

    <label for="email">correo</label>
    <input type="email" name="email" id=""><br><br>

    <label for="password">contraseña</label>
    <input type="password" name="password" min="8" max="20" id=""><br><br>

    <button type="submit">Enviar</button>
</form>
