<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalendarioAlertaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $evento;
    public $usuario;
    public $diasFaltantes;

    public function __construct($evento, $usuario)
    {
        $this->evento = $evento;
        $this->usuario = $usuario;
        $this->diasFaltantes = now()->diffInDays(\Carbon\Carbon::parse($evento->fecha), false);
    }

    public function build()
    {
        return $this->subject('Alerta de Plazo Próximo en Calendario')
            ->view('emails.calendario_alerta')
            ->with(['diasFaltantes' => $this->diasFaltantes]);
    }
}
