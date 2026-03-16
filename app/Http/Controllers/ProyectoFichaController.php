<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proyecto;

class ProyectoFichaController extends Controller
{
    public function show($id)
    {
        $proyecto = Proyecto::with(['archivos', 'calendarios', 'comuna', 'programa'])->findOrFail($id);
        return view('proyectos.ficha', compact('proyecto'));
    }
}
