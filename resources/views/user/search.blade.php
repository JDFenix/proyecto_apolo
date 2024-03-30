@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($users->isNotEmpty())
            <div class="row row-cols-1 row-cols-md-2">
                @foreach ($users as $user)
                    @if ($user->rol != Auth::user()->rol)
                        <div class="col mb-4">
                            <a href="{{ route('user.externalPerfil', ['id' => $user->id]) }}">
                                <div class="card h-100 mt-2"
                                    style="max-width: 1376px; margin-right: 20px; border-radius:16px">
                                    <div class="card-body d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $user->avatar }}" class=" img-fluid"
                                                style="width: 9%; border-radius: 15%;">
                                            <div class="ml-3" style="margin-left:1rem ">
                                                <h5 class="card-title" >
                                                    {{ $user->name }}{{ $user->paternal_surname }}{{ $user->maternal_surname }}
                                                </h5>
                                                {{-- <p class="card-text">{{ $user->teacher->subject }}</p> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <p>No se encontraron usuarios.</p>
        @endif
    </div>
@endsection
