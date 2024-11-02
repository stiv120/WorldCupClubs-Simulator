@extends('template')
@push('styles')
    @vite(['resources/js/players/index.js'])
@endpush
@section('content')
    <div class="content">
        <div class="container my-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Listado de Jugadores</h2>
                    <button type="button" class="btn btn-success" data-bs-modal="modal"
                        data-bs-toggle="modal" data-bs-target="#modalCrearJugador">
                        <i class="fas fa-plus"></i> Crear Jugador
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Nacionalidad</th>
                                <th>Edad</th>
                                <th>Posición</th>
                                <th>Número</th>
                                <th>Equipo</th>
                                <th>Foto</th>
                            </tr>
                        </thead>
                        <tbody class="divListadoJugadores">
                            @include('players/list')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @parent
    @include('players/modals')
@endsection
