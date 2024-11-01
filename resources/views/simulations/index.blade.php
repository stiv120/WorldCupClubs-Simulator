@extends('template')
@push('styles')
    @vite(['resources/js/simulations/index.js'])
@endpush
@section('content')
    <div class="content">
        <div class="container my-5">
            <div class="alert alert-info">
                <p><i class="fas fa-info-circle"></i> Reglas de la simulación. <br>
                    <ul>
                        <li>Deben existir al menos 8 equipos registrados.</li>
                        <li>Por cada equipo se debe registrar al menos 11 jugadores.</li>
                    </ul>
                </p>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Simulación del Torneo</h2>
                    <button type="button" class="btn btn-primary" id="btnCrearSimulacion">
                        <i class="fas fa-play"></i> Iniciar Simulación
                    </button>
                </div>
                <div class="card-body" id="simulationContainer">
                    @component('components/validation-errors')
                        @slot('titulo', 'Por favor, verifica la siguiente información:')
                    @endcomponent
                    <div class="row">
                        <div class="col-12 divSeccionesSimulaciones">
                            @include('simulations/sections')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
