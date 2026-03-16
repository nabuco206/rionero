<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;

class ArchivoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'id_tipo' => 'required|exists:tbl_tipos,id',
            'id_proyecto' => 'required|exists:tbl_proyectos,id',
        ]);
        Archivo::create($validated);
        return redirect()->back()->with('success', 'Archivo guardado correctamente');
    }
}
