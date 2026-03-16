<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendario;

class CalendarioController extends Controller
{
    public function store(Request $request)
    {

        try {
            $validated = $request->validate([
                'fecha' => 'required|date',
                'descripcion' => 'nullable|string',
                'tipo' => 'required|integer',
                'id_proyecto' => 'required|integer',
            ]);

            $calendario = new Calendario();
            $calendario->fecha = $validated['fecha'];
            $calendario->descripcion = $validated['descripcion'];
            $calendario->id_tipo = $validated['tipo'];
            $calendario->id_proyecto = $validated['id_proyecto'];
            $calendario->estado = true;
            $calendario->save();

            // Si es AJAX, devolver JSON
            if ($request->ajax()) {
                return response()->json(['success' => true, 'message' => 'Calendario agregado correctamente']);
            }
            return redirect()->back()->with('success', 'Calendario agregado correctamente');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function index()
    {
        $eventos = Calendario::all(['id', 'fecha', 'descripcion']);
        return view('calendario.index', compact('eventos'));
    }
}
