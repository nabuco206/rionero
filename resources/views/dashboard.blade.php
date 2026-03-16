@extends('adminlte::page')

@section('title', 'Tablero')

@section('content_header')
    <h1>Panel de Control</h1>
@stop

@section('content')
    <p>Bienvenido a tu proyecto Laravel en 2026.</p>

    <!-- Botón para abrir el modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addCalendarioModal">
        Agregar Calendario
    </button>

    <!-- Incluir el modal -->
    {{-- @include('components.add-calendario-modal') --}}
@stop
