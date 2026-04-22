<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $nombre;
    public string $correo;
    public string $mensaje;

    public function __construct(string $nombre, string $correo, string $mensaje)
    {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->mensaje = $mensaje;
    }

    public function build()
    {
        return $this->subject('Nuevo mensaje de contacto - RioNero')
            ->replyTo($this->correo, $this->nombre)
            ->view('emails.contacto');
    }
}
