@extends('adminlte::page')

@section('title', 'Ficha de Proyecto')

@section('content_header')
    <h1>Ficha de Proyecto</h1>
@endsection

@section('content')
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Datos del Proyecto</div>
        <div class="card-body">
            <strong>ID:</strong> {{ $proyecto->id }}<br>
            <strong>Código:</strong> {{ $proyecto->codigo }}<br>
            <strong>Nombre:</strong> {{ $proyecto->nombre }}<br>
            <strong>Comuna:</strong> {{ $proyecto->comuna->gls_comuna ?? '-' }}<br>
            <strong>Programa:</strong> {{ $proyecto->programa->gls_programa ?? '-' }}<br>
            <strong>Supervisores:</strong> {{ $proyecto->supervisor_1 }}{{ $proyecto->supervisor_2 ? ', ' . $proyecto->supervisor_2 : '' }}<br>
            <strong>Beneficiarios:</strong> {{ $proyecto->nmro_beneficiarios }}<br>
            <strong>Fecha:</strong> {{ $proyecto->fecha }}<br>
            <strong>Estado:</strong> {{ $proyecto->estado ? 'Activo' : 'Inactivo' }}<br>
            <div class="mt-3">
                <a href="{{ route('proyectos.edit', $proyecto->id) }}" class="btn btn-primary">Editar Proyecto <i class="fas fa-edit"></i></a>
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-info text-white">Archivos
            <button class="btn btn-success btn-sm float-end" data-toggle="modal" data-target="#modalArchivoFicha"><i class="fas fa-plus"></i> Agregar Archivo</button>
        </div>
        <div class="card-body">
            @if($proyecto->archivos && count($proyecto->archivos))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Archivo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyecto->archivos as $archivo)
                            <tr>
                                <td>{{ $archivo->nombre }}</td>
                                <td>{{ $archivo->tipo ? $archivo->tipo->gls_tipo : '-' }}</td>
                                <td><a href="{{ $archivo->ruta ?? $archivo->path }}" target="_blank">Ver archivo</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay archivos asociados.</p>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-warning text-dark">Fechas de Calendario
            <button class="btn btn-warning btn-sm float-end" data-toggle="modal" data-target="#modalCalendarioFicha"><i class="fas fa-calendar-plus"></i> Agregar Fecha</button>
        </div>
        <div class="card-body">
            @if($proyecto->calendarios && count($proyecto->calendarios))
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Tipo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proyecto->calendarios as $calendario)
                            <tr>
                                <td>{{ $calendario->fecha }}</td>
                                <td>{{ $calendario->descripcion }}</td>
                                <td>{{ $calendario->tipo ? $calendario->tipo->gls_tipo : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay fechas en el calendario.</p>
            @endif
        </div>
    </div>

    <!-- Modal para agregar archivo -->
    <div class="modal fade" id="modalArchivoFicha" tabindex="-1" role="dialog" aria-labelledby="modalArchivoFichaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArchivoFichaLabel">Agregar Archivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('proyectos.archivo_form', ['proyecto_id' => $proyecto->id])
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para agregar calendario -->
    <div class="modal fade" id="modalCalendarioFicha" tabindex="-1" role="dialog" aria-labelledby="modalCalendarioFichaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCalendarioFichaLabel">Agregar Fecha al Calendario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @include('proyectos.calendario_form', ['proyecto_id' => $proyecto->id])
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Enviar formulario de archivo por AJAX
    $(document).on('submit', '#modalArchivoFicha form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#modalArchivoFicha').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                $('#modalArchivoFicha .modal-body').prepend('<div class="alert alert-danger">Error al guardar. Revisa los datos.</div>');
            }
        });
    });

    // Enviar formulario de calendario por AJAX
    $(document).on('submit', '#modalCalendarioFicha #formCalendario', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#modalCalendarioFicha').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                $('#modalCalendarioFicha .modal-body').prepend('<div class="alert alert-danger">Error al guardar. Revisa los datos.</div>');
            }
        });
    });
});
</script>
@endpush
