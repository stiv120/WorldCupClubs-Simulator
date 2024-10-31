<modal id="create-team-modal" title="Crear Equipo">
    <form id="formCrearEquipo">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="nombre" class="form-control">
        </div>
    </form>
</modal>

<div class="modal fade" id="createTeamForm" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="createTeamFormLabel"
    aria-hidden="true">
    <form id="formCrearEquipo">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createTeamFormLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @include('teams/create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Understood</button>
                </div>
            </div>
        </div>
    </form>
</div>
