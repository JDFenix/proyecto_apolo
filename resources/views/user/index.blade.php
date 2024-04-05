@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                {{-- <i class="bi bi-patch-plus-fill"></i> --}}
                @if ($advisories->isNotEmpty())
                    @php
                        $sortedAdvisories = $advisories->sortBy(function ($item, $key) {
                            return Carbon\Carbon::parse($item->date . ' ' . $item->time);
                        });

                        $groupedAdvisories = $sortedAdvisories->groupBy(function ($item, $key) {
                            return Carbon\Carbon::parse($item->date)->format('Y-m-d');
                        });
                    @endphp

                    @foreach ($groupedAdvisories as $date => $advisories)
                        <h4 style="color:#022D74" class="mt-2">{{ $date }}</h4>
                        @foreach ($advisories as $Oneadvisory)
                            <div class="card mt-2"
                                style="width: 100%; max-width: 1376px; margin-right: 20px; border-radius:16px">
                                <div class="card-body d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ asset('images/icon_asesory_generic.png') }}" class=" img-fluid"
                                            style="width: 9%; border-radius: 15%;">
                                        <div class="ml-3" style="margin-left:1rem ">
                                            <h5 class="card-title">{{ $Oneadvisory->tittle }}</h5>
                                            <p class="card-text">{{ $Oneadvisory->date }} {{ $Oneadvisory->time }}</p>
                                            @if (Auth::user()->rol == 'student')
                                                {{ $Oneadvisory->subject }} {{ $Oneadvisory->teacher->name }}
                                            @else
                                                {{ $Oneadvisory->subject }}
                                            @endif
                                        </div>
                                    </div>
                                    @if (Auth::user()->rol == 'student')
                                        <h6 class="mb-2" style="position: absolute; margin-left:89%; margin-top:-2%">
                                            {{ $Oneadvisory->status }}
                                        </h6>
                                        <form
                                            action="{{ route('subscribe.advisory', ['studentId' => Auth::user()->id, 'advisoryId' => $Oneadvisory->id]) }}"
                                            method="post">
                                            @csrf
                                            <input type="hidden" name="subscribe_token"
                                                value="{{ Session::get('subscribe_token') }}">
                                            <button type="submit" style="background-color:#022D74"
                                                class="btn btn-primary btn-custom rounded-pill mt-5 px-5 py-2">
                                                {{ $Oneadvisory->isSubscribed ? 'Desuscribir' : 'Inscribir' }}
                                            </button>
                                        </form>
                                    @else
                                        <h6 class="mb-2" style="position: absolute; margin-left:90%; margin-top:-2%">
                                            {{ $Oneadvisory->status }}
                                        </h6>
                                        <a href="{{ route('advisory.modify', ['advisoryId' => $Oneadvisory->id]) }}"
                                            style="background-color: #022D74"
                                            class="btn btn-primary rounded-pill mt-5 px-5 py-2">
                                            Modificar
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @else
                    @if (Auth::user()->rol == 'student')
                   
                        <div class="container mb-5">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <h1 class="text-center" style=" color: #022D74;">No hay asesorias a inscribirse</h1>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <h1 class="text-center" style=" color: #022D74;">No hay asesorias registradas en este
                                        momento</h1>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif




            @endsection

            @section('footer')
                @include('layouts.footer')
            @endsection
