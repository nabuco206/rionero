@extends('adminlte::page')

@section('title', 'Crear ')

@section('content_header')
    <h1>Crear PR</h1>
@endsection

@section('content')
    <form action="{{ route('proyectos.store') }}" method="POST">
        @csrf
        <div class="container-fluid" style="max-width:900px">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_comuna" class="form-label">Comuna</label>
                    <select name="id_comuna" class="form-control" required>
                        @foreach($comunas as $comuna)
                            <option value="{{ $comuna->id }}">{{ $comuna->gls_comuna }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_programa" class="form-label">Programa</label>
                    <select name="id_programa" class="form-control" required>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->id }}">{{ $programa->gls_programa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="supervisor_1" class="form-label">Supervisor 1</label>
                    <input type="text" name="supervisor_1" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="supervisor_2" class="form-label">Supervisor 2</label>
                    <input type="text" name="supervisor_2" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nmro_beneficiarios" class="form-label">N° Beneficiarios</label>
                    <input type="number" name="nmro_beneficiarios" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nmro_resolucion" class="form-label">N° Resolución</label>
                    <input type="text" name="nmro_resolucion" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_resolucion" class="form-label">Fecha Resolución</label>
                    <input type="date" name="fecha_resolucion" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_ini_obra" class="form-label">Fecha Inicio Obra</label>
                    <input type="date" name="fecha_ini_obra" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Etiqueta</label>
                    <select name="color" id="color" class="form-control" style="font-weight:bold;">
                        <option value="">Sin Etiqueta</option>
                        <option value="rojo" style="background:#e74c3c;color:#fff;">Rojo</option>
                        <option value="amarillo" style="background:#f1c40f;color:#333;">Amarillo</option>
                        <option value="celeste" style="background:#3498db;color:#fff;">Celeste</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label>
                    <select name="estado" class="form-control" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </div>
    </form>
@endsection

@push('css')
@endpush

<style>
    .color-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 2px solid #ccc;
        margin: 0 8px;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
        box-shadow: 0 0 4px #0001;
        display: inline-block;
        background-clip: padding-box;
    }
    .color-circle.selected {
        border-color: #000;
        box-shadow: 0 0 0 4px #0003;
    }
    .color-red { background: #ff0000 !important; }
    .color-yellow { background: #ffc107 !important; }
    .color-blue { background: #00bfff !important; }
    #color.form-control { font-weight: bold; transition: background 0.2s, color 0.2s; }
    #color option[value="rojo"] { background: #e74c3c !important; color: #fff !important; }
    #color option[value="amarillo"] { background: #f1c40f !important; color: #333 !important; }
    #color option[value="celeste"] { background: #3498db !important; color: #fff !important; }
    #color option[value=""] { background: #fff !important; color: #333 !important; }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('color');
        function updateSelectStyle() {
            var color = select.value;
            var bg = '#fff', fg = '#333';
            if(color === 'rojo') { bg = '#e74c3c'; fg = '#fff'; }
            else if(color === 'amarillo') { bg = '#f1c40f'; fg = '#333'; }
            else if(color === 'celeste') { bg = '#3498db'; fg = '#fff'; }
            select.style.backgroundColor = bg;
            select.style.color = fg;
        }
        select.addEventListener('change', updateSelectStyle);
        updateSelectStyle();
    });
</script>
