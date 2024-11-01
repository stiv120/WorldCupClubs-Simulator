<div class="modal fade" id="modalCrearJugador" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCrearJugadorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalCrearJugadorLabel">Crear jugador</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formCrearJugador">
                <div class="modal-body">
                    @include('components.validation-errors')
                    @include('players/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btnCerrarModalJugador"
                        data-bs-dismiss="modal">
                        Cerrar
                    </button>
                    <button type="submit" class="btn btn-primary btnGuardarJugador">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span class="btnGuardarJugadorText">Guardar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
