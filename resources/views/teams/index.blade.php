@extends('template')
@push('styles')
    @vite(['resources/js/teams/index.js'])
@endpush
@section('content')
    <div class="content">
        <div class="container my-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Listado de Equipos</h2>
                    <button type="button" class="btn btn-success" data-bs-modal="modal"
                        data-bs-toggle="modal" data-bs-target="#modalCrearEquipo">
                        <i class="fas fa-plus"></i> Crear Equipo
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>País</th>
                                <th>Bandera</th>
                            </tr>
                        </thead>
                        <tbody class="divListadoEquipos">
                            @include('teams/list')
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @parent
    @include('teams/modals')
@endsection
