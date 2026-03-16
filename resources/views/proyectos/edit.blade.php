@extends('adminlte::page')

@section('title', 'Editar Proyecto')

@section('content_header')
    <h1>Editar Proyecto</h1>
@endsection

@section('content')
    <form action="{{ route('proyectos.update', $proyecto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container-fluid" style="max-width:900px">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" name="codigo" class="form-control" value="{{ $proyecto->codigo }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $proyecto->nombre }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_comuna" class="form-label">Comuna</label>
                    <select name="id_comuna" class="form-control" required>
                        @foreach($comunas as $comuna)
                            <option value="{{ $comuna->id }}" @if($proyecto->id_comuna == $comuna->id) selected @endif>{{ $comuna->gls_comuna }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="id_programa" class="form-label">Programa</label>
                    <select name="id_programa" class="form-control" required>
                        @foreach($programas as $programa)
                            <option value="{{ $programa->id }}" @if($proyecto->id_programa == $programa->id) selected @endif>{{ $programa->gls_programa }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="supervisor_1" class="form-label">Supervisor 1</label>
                    <input type="text" name="supervisor_1" class="form-control" value="{{ $proyecto->supervisor_1 }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="supervisor_2" class="form-label">Supervisor 2</label>
                    <input type="text" name="supervisor_2" class="form-control" value="{{ $proyecto->supervisor_2 }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nmro_beneficiarios" class="form-label">N° Beneficiarios</label>
                    <input type="number" name="nmro_beneficiarios" class="form-control" value="{{ $proyecto->nmro_beneficiarios }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="nmro_resolucion" class="form-label">N° Resolución</label>
                    <input type="text" name="nmro_resolucion" class="form-control" value="{{ $proyecto->nmro_resolucion }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_resolucion" class="form-label">Fecha Resolución</label>
                    <input type="date" name="fecha_resolucion" class="form-control" value="{{ $proyecto->fecha_resolucion }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_ini_obra" class="form-label">Fecha Inicio Obra</label>
                    <input type="date" name="fecha_ini_obra" class="form-control" value="{{ $proyecto->fecha_ini_obra }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="fecha_vencimiento" class="form-label">Fecha Vencimiento</label>
                    <input type="date" name="fecha_vencimiento" class="form-control" value="{{ $proyecto->fecha_vencimiento }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="color" class="form-label">Etiqueta</label>
                    <select name="color" id="color" class="form-control" style="font-weight:bold;">
                        <option value="" @if(empty($proyecto->color)) selected @endif>Sin Etiqueta</option>
                        <option value="rojo" style="background:#e74c3c;color:#fff;" @if($proyecto->color=='rojo') selected @endif>Rojo</option>
                        <option value="amarillo" style="background:#f1c40f;color:#333;" @if($proyecto->color=='amarillo') selected @endif>Amarillo</option>
                        <option value="celeste" style="background:#3498db;color:#fff;" @if($proyecto->color=='celeste') selected @endif>Celeste</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="estado" class="form-label">Estado</label><br>
                    <input type="hidden" name="estado" value="0">
                    <label class="switch">
                        <input type="checkbox" id="estadoSwitch" name="estado" value="1" {{ $proyecto->estado ? 'checked' : '' }}>
                        <span class="slider"></span>
                    </label>
                    <span id="estadoSwitchLabel" style="margin-left:10px; font-weight:bold;">{{ $proyecto->estado ? 'Activo' : 'Inactivo' }}</span>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var select = document.getElementById('color');
                        if (select) {
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
                        }
                        // Estado switch label update y valor
                        var estadoSwitch = document.getElementById('estadoSwitch');
                        var estadoLabel = document.getElementById('estadoSwitchLabel');
                        if(estadoSwitch && estadoLabel) {
                            estadoSwitch.addEventListener('change', function() {
                                estadoLabel.textContent = estadoSwitch.checked ? 'Activo' : 'Inactivo';
                            });
                        }
                    });
                </script>
                <style>
                        .switch {
                            position: relative;
                            display: inline-block;
                            width: 50px;
                            height: 28px;
                        }
                        .switch input {display:none;}
                        .slider {
                            position: absolute;
                            cursor: pointer;
                            top: 0; left: 0; right: 0; bottom: 0;
                            background-color: #ccc;
                            transition: .4s;
                            border-radius: 28px;
                        }
                        .slider:before {
                            position: absolute;
                            content: "";
                            height: 22px;
                            width: 22px;
                            left: 3px;
                            bottom: 3px;
                            background-color: white;
                            transition: .4s;
                            border-radius: 50%;
                        }
                        input:checked + .slider {
                            background-color: #28a745;
                        }
                        input:checked + .slider:before {
                            transform: translateX(22px);
                        }
                </style>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ route('proyectos.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
        </div>
    </form>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Color select visual
        var select = document.getElementById('color');
        if (select) {
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
        }
        // Estado switch label update y valor
        var estadoSwitch = document.getElementById('estadoSwitch');
        var estadoLabel = document.getElementById('estadoSwitchLabel');
        var hiddenEstado = document.querySelector('input[name="estado_hidden"]');
        if(estadoSwitch && estadoLabel && hiddenEstado) {
            estadoSwitch.addEventListener('change', function() {
                estadoLabel.textContent = estadoSwitch.checked ? 'Activo' : 'Inactivo';
                // Si está checked, el valor enviado será 1, si no, 0
                if(!estadoSwitch.checked) {
                    estadoSwitch.value = 1; // Laravel solo envía el checkbox si está checked
                }
            });
        }
    });
</script>
