@php
    use App\Models\Tipo;
    $tipos = Tipo::where('tipo', 1)->get();
@endphp
<form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" id="formArchivo">
    @csrf
    <input type="hidden" name="id_proyecto" value="{{ $proyecto_id }}">
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre del archivo</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="archivo" class="form-label">Archivo</label>
        <input type="file" name="archivo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="id_tipo" class="form-label">Tiposhhhhh</label>
        <select name="id_tipo" class="form-control" required>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}">{{ $tipo->gls_tipo }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar archivo</button>
</form>
