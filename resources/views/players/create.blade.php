<div class="form-group row mb-3">
    <div class="col-6">
        <label for="nombre">Nombre</label>
        <input type="text"
            name="nombre"
            class="form-control"
            required>
    </div>
    <div class="col-6">
        <label for="nacionalidad">Nacionalidad</label>
        <input type="text"
            name="nacionalidad"
            class="form-control"
            required>
    </div>
</div>
<div class="form-group row mb-3">
    <div class="col-6">
        <label for="edad">Edad</label>
        <input type="number"
            name="edad"
            class="form-control"
            min="15"
            max="50"
            required>
    </div>
    <div class="col-6">
        <label for="posicion">Posición</label>
        <select name="posicion"
            class="form-control"
            required>
            <option value="">Seleccione una posición</option>
            <option value="Portero">Portero</option>
            <option value="Defensa">Defensa</option>
            <option value="Centrocampista">Centrocampista</option>
            <option value="Delantero">Delantero</option>
        </select>
    </div>
</div>
<div class="form-group row mb-3">
    <div class="col-6">
        <label for="numero_camiseta">Número de Camiseta</label>
        <input type="number"
            name="numero_camiseta"
            class="form-control"
            min="1"
            max="99"
            required>
    </div>
    <div class="col-6">
        <label for="equipo_id">Equipo</label>
        <select name="equipo_id"
            class="form-control"
            required>
            <option value="">Seleccione un equipo</option>
            @foreach($equipos as $equipo)
                <option value="{{ $equipo?->id }}">{{ $equipo?->nombre }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group row mb-3">
    <div class="col-12">
        <label for="url_foto">Foto del Jugador</label>
        <input type="file"
            name="url_foto"
            class="form-control"
            accept="image/jpeg,image/png,image/jpg,image/gif"
            required>
    </div>
</div>
