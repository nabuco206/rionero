<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactoController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:100'],
            'correo' => ['required', 'email', 'max:150'],
            'mensaje' => ['required', 'string', 'max:2000'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe tener un formato válido.',
            'mensaje.required' => 'El mensaje es obligatorio.',
        ]);

        if ($validator->fails()) {
            return redirect('/#contacto')
                ->withErrors($validator)
                ->withInput();
        }

        $validated = $validator->validated();

        $destinatario = config('mail.contact_to');

        if (blank($destinatario)) {
            return redirect('/#contacto')
                ->withInput()
                ->with('error_contacto', 'No se configuró el correo de destino. Revisa MAIL_CONTACT_TO en .env.');
        }

        Mail::to($destinatario)->send(new ContactoMail(
            $validated['nombre'],
            $validated['correo'],
            $validated['mensaje']
        ));

        return redirect()
            ->to('/#contacto')
            ->with('success_contacto', '¡Gracias! Tu mensaje fue enviado correctamente.');
    }
}
