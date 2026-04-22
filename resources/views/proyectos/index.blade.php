@extends('adminlte::page')

@section('title', 'Listado de Proyectos')

@section('content_header')
    <h1>Proyectos</h1>
@endsection

@section('content')
    @if(!empty($color))
        @php
            $labelColor = match($color) {
                'rojo' => 'Rojo',
                'amarillo' => 'Amarillo',
                'celeste' => 'Celeste',
                'sin-color' => 'Sin color',
                default => ucfirst($color),
            };
        @endphp
        <div class="alert alert-info d-flex justify-content-between align-items-center">
            <span>Filtro activo por color: <strong>{{ $labelColor }}</strong></span>
            <a href="{{ route('proyectos.index') }}" class="btn btn-sm btn-outline-primary">Quitar filtro</a>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <button class="btn btn-success mb-3" id="btnCrearProyecto">Crear Proyecto</button>
            <table class="table table-bordered table-hover" id="tablaProyectos">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Comuna</th>
                        <th>Programa</th>
                        <th>Supervisores</th>
                        <th>Beneficiarios</th>
                        <th>NmroResolución</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th></th>
                        <th></th>
                        <th>Acciones</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Código" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Nombre" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Comuna" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Programa" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Supervisores" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Beneficiarios" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar NmroResolucion" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Fecha" /></th>
                        <th><input type="text" class="form-control form-control-sm" placeholder="Buscar Estado" /></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($proyectos as $proyecto)
                        <tr>
                            <td>
                                @if($proyecto->color)
                                    <span style="display:inline-block;width:24px;height:24px;border-radius:50%;border:2px solid #ccc;vertical-align:middle;
                                        @if($proyecto->color=='rojo')background:#e74c3c;@elseif($proyecto->color=='amarillo')background:#f1c40f;@elseif($proyecto->color=='celeste')background:#3498db;@else background:#fff;@endif">
                                    </span>
                                @else
                                    <span style="display:inline-block;width:24px;height:24px;border-radius:50%;border:2px solid #ccc;background:#fff;vertical-align:middle;"></span>
                                @endif
                            </td>
                            <td><a href="{{ route('proyectos.ficha', $proyecto->id) }}" class="btn btn-info btn-sm me-1" title="Ver Ficha"><i class="fa fa-eye"></i></a></td>
                            <td>{{ $proyecto->codigo }}</td>
                            <td>{{ $proyecto->nombre }}</td>
                            <td>{{ $proyecto->comuna->gls_comuna ?? '-' }}</td>
                            <td>{{ $proyecto->programa->gls_programa ?? '-' }}</td>
                            <td>{{ $proyecto->supervisor_1 }}{{ $proyecto->supervisor_2 ? ', ' . $proyecto->supervisor_2 : '' }}</td>
                            <td>{{ $proyecto->nmro_beneficiarios }}</td>
                            <td>{{ $proyecto->nmro_resolucion }}</td>
                            <td>{{ $proyecto->fecha }}</td>
                            <td>{{ $proyecto->estado ? 'Activo' : 'Inactivo' }}</td>
                            <td><button class="btn btn-info btn-sm btnArchivoProyecto me-1" data-id="{{ $proyecto->id }}" title="Agregar Archivos"><i class="fas fa-paperclip"></i></button></td>
                            <td><button class="btn btn-warning btn-sm btnCalendarioProyecto" data-id="{{ $proyecto->id }}" title="Agregar Fechas"><i class="fas fa-calendar-plus"></i></button></td>
                            <td>
                                <div class="d-flex flex-row gap-1">
                                    
                                    <button class="btn btn-primary btn-sm btnEditarProyecto me-1" data-id="{{ $proyecto->id }}" title="Editar"><i class="fas fa-edit"></i></button>
                                    &nbsp;&nbsp;&nbsp;
                                    <form action="{{ route('proyectos.destroy', $proyecto->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm me-1" onclick="return confirm('¿Está seguro de eliminar este proyecto?')" title="Eliminar"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>

                            </tr>
                        @endforeach
                        <!-- Modal para Archivos -->
                        <div class="modal fade" id="modalArchivo" tabindex="-1" role="dialog" aria-labelledby="modalArchivoLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalArchivoLabel">Agregar Archivos</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modalArchivoBody">
                                        @php $proyecto_id = null; @endphp
                                        @include('proyectos.archivo_form', ['proyecto_id' => $proyecto_id])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal para Calendario -->
                        <div class="modal fade" id="modalCalendario" tabindex="-1" role="dialog" aria-labelledby="modalCalendarioLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalCalendarioLabel">Agregar Fecha al Calendario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" id="modalCalendarioBody">
                                        @php $proyecto_id = null; @endphp
                                        @include('proyectos.calendario_form', ['proyecto_id' => $proyecto_id])
                                    </div>
                                </div>
                            </div>
                        </div>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal AdminLTE -->
    <div class="modal fade" id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="modalProyectoLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalProyectoLabel">Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="modalProyectoBody">
            <!-- Aquí se carga el formulario por AJAX -->
          </div>
        </div>
      </div>
    </div>

@push('js')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    // Inicializar DataTable
    var table = $('#tablaProyectos').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
        },
        orderCellsTop: true,
        fixedHeader: true
    });

    // Filtros por columna
    $('#tablaProyectos thead tr:eq(1) th').each(function(i) {
        $('input', this).on('keyup change', function() {
            if (table.column(i).search() !== this.value) {
                table.column(i).search(this.value).draw();
            }
        });
    });

    // ...el resto de tu código jQuery...
    // Abrir modal para crear
    $('#btnCrearProyecto').click(function(e) {
        e.preventDefault();
        $('#modalProyectoLabel').text('Crear Proyecto');
        $.get("{{ route('proyectos.create') }}", function(data) {
            $('#modalProyectoBody').html($(data).find('form'));
            $('#modalProyecto').modal('show');
        });
    });

    // Abrir modal para editar
    $('.btnEditarProyecto').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modalProyectoLabel').text('Editar Proyecto');
        $.get('/proyectos/' + id + '/edit', function(data) {
            $('#modalProyectoBody').html($(data).find('form'));
            $('#modalProyecto').modal('show');
        });
    });

    // Abrir modal para archivos
    $('.btnArchivoProyecto').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modalArchivo').modal('show');
        // Asignar el id al input hidden del formulario
        $('#modalArchivoBody input[name="id_proyecto"]').val(id);
    });

    // Enviar formulario de archivo por AJAX
    $(document).on('submit', '#formArchivo', function(e) {
        e.preventDefault();
        var form = $(this)[0];
        var formData = new FormData(form);
        $('#modalArchivoBody .alert').remove();
        $.ajax({
            url: $(form).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modalArchivo').modal('hide');
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
                $('#modalArchivoBody').prepend(msg);
            }
        });
    });

    // Abrir modal para calendario
    $('.btnCalendarioProyecto').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#modalCalendario').modal('show');
        // Asignar el id al input hidden del formulario
        $('#id_proyecto_calendario').val(id);
    });

    // Enviar formulario por AJAX
    $(document).on('submit', '#modalProyectoBody form', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.find('input[name="_method"]').val() || form.attr('method');
        // Limpiar mensajes anteriores
        $('#modalProyectoBody .alert').remove();
        $.ajax({
            url: url,
            type: method,
            data: form.serialize(),
            success: function(response) {
                $('#modalProyecto').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                let msg = '';
                if(xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    // Mostrar todos los mensajes de error de validación
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        if(errors.hasOwnProperty(field)) {
                            msg += '<div class="alert alert-danger">'+errors[field][0]+'</div>';
                        }
                    }
                } else if(xhr.status === 405) {
                    msg = '<div class="alert alert-success" id="msg-success">Proyecto actualizado correctamente.</div>';
                    $('#modalProyectoBody').prepend(msg);
                    setTimeout(function() {
                        $('#modalProyecto').modal('hide');
                        location.reload();
                    }, 2000);
                    return;
                } else {
                    msg = '<div class="alert alert-danger">Error al guardar. Revisa los datos.</div>';
                }
                $('#modalProyectoBody').prepend(msg);
            }
        });
    });

    // Enviar formulario calendario por AJAX
    $(document).on('submit', '#formCalendario', function(e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                $('#modalCalendario').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                $('#modalCalendarioBody').prepend('<div class="alert alert-danger">Error al guardar. Revisa los datos.</div>');
            }
        });
    });
});
</script>
@endpush
@endsection

@push('css')
<style>
    .navbar-search-block,
    .navbar-expand .navbar-nav .nav-item .nav-link[data-widget="fullscreen"],
    .navbar-expand .navbar-nav .nav-item .nav-link[data-widget="navbar-search"],
    .navbar-expand .navbar-nav .nav-item .nav-link i.fa-search {
        display: none !important;
    }
</style>
@endpush
