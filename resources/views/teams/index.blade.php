@extends('template')
@section('content')
    <div class="content">
        <div class="container my-5">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Listado de Equipos</h2>
                    <a href="#" class="btn btn-success">Crear Equipo</a>
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
                  </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    @parent
@show
