<div class="modal fade" id="modalCrearEquipo" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCrearEquipoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCrearEquipoLabel">Crear equipo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearEquipo">
                <div class="modal-body">
                    @include('components.validation-errors')
                    @include('teams/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCerrarModalEquipo"
                        data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary btnGuardarEquipo">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span class="btnGuardarEquipoText">Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
