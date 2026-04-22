<?php

namespace App\Jobs;

use App\Models\Calendario;
use App\Models\User;
use App\Mail\CalendarioAlertaMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RevisarCalendarioJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $diasAviso = (int) env('CALENDARIO_DIAS_AVISO', 3);
        $enviarTodos = filter_var(env('CALENDARIO_ENVIAR_TODOS', false), FILTER_VALIDATE_BOOLEAN);
        $hoy = now()->startOfDay();
        $fechaObjetivo = $hoy->copy()->addDays($diasAviso);

        $eventos = Calendario::with(['proyecto', 'tipo'])
            ->when(!$enviarTodos, function ($query) use ($fechaObjetivo) {
                $query->whereDate('fecha', $fechaObjetivo)
                    ->where('estado', true);
            })
            ->get();

        if ($eventos->isEmpty()) {
            Log::info('No hay eventos de calendario para alertar', [
                'modo' => $enviarTodos ? 'todos' : 'fecha_objetivo',
                'fecha_objetivo' => $fechaObjetivo->toDateString(),
                'dias_aviso' => $diasAviso,
            ]);
            return;
        }

        $usuarios = User::whereNotNull('email')->get();

        foreach ($eventos as $evento) {
            foreach ($usuarios as $usuario) {
                Mail::to($usuario->email)->queue(new CalendarioAlertaMail($evento, $usuario));
            }
        }

        Log::info('Correos de alerta de calendario encolados', [
            'modo' => $enviarTodos ? 'todos' : 'fecha_objetivo',
            'fecha_objetivo' => $fechaObjetivo->toDateString(),
            'eventos' => $eventos->count(),
            'usuarios' => $usuarios->count(),
            'total_correos' => $eventos->count() * $usuarios->count(),
        ]);
    }
}
