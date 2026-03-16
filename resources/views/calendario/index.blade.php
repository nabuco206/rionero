@extends('adminlte::page')

@section('title', 'Calendario')

@section('content_header')
    <h1>Calendario</h1>
@endsection

@section('content')
    <div id="calendar"></div>
@endsection

@section('js')
    <!-- FullCalendar CSS y JS desde CDN (solo global) -->
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css' rel='stylesheet' />
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                locale: 'es', // Español
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Agenda'
                },
                events: [
                    @foreach($eventos as $evento)
                        {
                            title: @json($evento->descripcion ?? 'Evento'),
                            start: @json($evento->fecha),
                        },
                    @endforeach
                ]
            });
            calendar.render();
        });
    </script>
@endsection
