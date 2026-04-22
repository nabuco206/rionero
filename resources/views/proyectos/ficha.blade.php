@extends('adminlte::page')

@section('title', 'Ficha de Proyecto')

@section('content_header')
    <h1>Ficha de Proyecto</h1>
@endsection

@section('content')
    @php
        $toKb = function ($value) {
            $value = trim((string) $value);
            if ($value === '') {
                return 0;
            }

            $unit = strtolower(substr($value, -1));
            $number = (float) $value;

            return match ($unit) {
                'g' => (int) round($number * 1024 * 1024),
                'm' => (int) round($number * 1024),
                'k' => (int) round($number),
                default => (int) round($number / 1024),
            };
        };

        $maxArchivoKb = min(10240, $toKb(ini_get('upload_max_filesize')), $toKb(ini_get('post_max_size')));
        $maxArchivoKb = $maxArchivoKb > 0 ? $maxArchivoKb : 2048;
    @endphp

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
            <button class="btn btn-success btn-sm float-end" id="btnAgregarArchivoFicha"><i class="fas fa-plus"></i> Agregar Archivo</button>
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
                                <td>
                                    @if($archivo->path)
                                        <a href="{{ asset('storage/' . $archivo->path) }}" target="_blank">Ver archivo</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay archivos asociados.</p>
            @endif
        </div>
    </div>

    <!-- Modal para agregar archivo en ficha -->
    <div class="modal fade" id="modalArchivoFicha" tabindex="-1" role="dialog" aria-labelledby="modalArchivoFichaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalArchivoFichaLabel">Agregar Archivo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalArchivoFichaBody">
                    <form action="{{ route('archivos.store') }}" method="POST" enctype="multipart/form-data" id="formArchivoFicha">
                        @csrf
                        <input type="hidden" name="id_proyecto" value="{{ $proyecto->id }}">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre del archivo</label>
                            <input type="text" name="nombre" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="id_tipo" class="form-label">Tipo</label>
                            <select name="id_tipo" class="form-control" required>
                                @foreach(App\Models\Tipo::where('tipo', 1)->get() as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->gls_tipo }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="archivo" class="form-label">Archivo</label>
                            <input type="file" name="archivo" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.jpg,.jpeg,.png" data-max-bytes="{{ $maxArchivoKb * 1024 }}" required>
                            <small class="text-muted">Formatos permitidos: PDF, Word, Excel, CSV, JPG, PNG (máx. {{ round($maxArchivoKb / 1024, 2) }}MB).</small>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar archivo</button>
                    </form>
                </div>
            </div>
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
    // Abrir modal para agregar archivo en ficha
    $('#btnAgregarArchivoFicha').click(function(e) {
        e.preventDefault();
        $('#modalArchivoFicha').modal('show');
    });

    // Enviar formulario de archivo por AJAX en ficha
    $(document).on('submit', '#formArchivoFicha', function(e) {
        e.preventDefault();
        var form = $(this)[0];
        var fileInput = form.querySelector('input[name="archivo"]');
        var maxBytes = fileInput ? Number(fileInput.getAttribute('data-max-bytes') || 0) : 0;

        if (fileInput && fileInput.files && fileInput.files.length > 0 && maxBytes > 0) {
            var file = fileInput.files[0];
            if (file.size > maxBytes) {
                var maxMb = (maxBytes / (1024 * 1024)).toFixed(2);
                $('#modalArchivoFichaBody .alert').remove();
                $('#modalArchivoFichaBody').prepend('<div class="alert alert-danger">El archivo supera el tamaño máximo permitido por el servidor (' + maxMb + 'MB).</div>');
                return;
            }
        }

        var formData = new FormData(form);
        $('#modalArchivoFichaBody .alert').remove();
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modalArchivoFicha').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                let msg = '<div class="alert alert-danger">Error al guardar archivo. Revisa los datos.</div>';
                if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    msg = '';
                    for (let field in errors) {
                        if(errors.hasOwnProperty(field)) {
                            msg += '<div class="alert alert-danger">'+errors[field][0]+'</div>';
                        }
                    }
                }
                $('#modalArchivoFichaBody').prepend(msg);
            }
        });
    });
});
</script>
@endpush

@push('js')
<script>
$(document).ready(function() {
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
