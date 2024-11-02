@extends('template')
@push('styles')
    @vite(['resources/js/imports/index.js'])
@endpush
@section('content')
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2>Importar Equipos y Jugadores</h2>
            </div>
            <div class="card-body import-container position-relative">
                @component('components/validation-errors')
                    @slot('titulo', 'Por favor, verifica la siguiente información:')
                @endcomponent
                <form id="importForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="archivoCsv">Archivo CSV</label>
                        <input type="file" class="form-control" id="archivoCsv"
                            name="archivo" accept="text/csv,application/vnd.ms-excel,.csv" required>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">
                        <i class="fas fa-upload"></i> Importar
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
