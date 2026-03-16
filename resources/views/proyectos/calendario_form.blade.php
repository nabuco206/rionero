<form id="formCalendario" method="POST" action="{{ route('calendario.store') }}">
    @csrf
    <div class="form-group">
        <label for="fecha">Fecha</label>
        <input type="date" class="form-control" id="fecha" name="fecha" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <input type="text" class="form-control" id="descripcion" name="descripcion">
    </div>
    <input type="hidden" name="tipo" value="2">
    <input type="hidden" name="id_proyecto" value="{{ $proyecto_id ?? '' }}">
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
