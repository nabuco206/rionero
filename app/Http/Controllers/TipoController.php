<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipoController extends Controller
{
    public function index()
    {
        $tipos = \App\Models\Tipo::all();
        return view('tipos.index', compact('tipos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'gls_tipo' => 'required|string',
            'tipo' => 'required|string',
            'estado' => 'required|boolean',
        ]);
        \App\Models\Tipo::create($validated);
        return redirect()->back()->with('success', 'Tipo creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $tipo = \App\Models\Tipo::findOrFail($id);
        $validated = $request->validate([
            'gls_tipo' => 'required|string',
            'tipo' => 'required|string',
            'estado' => 'required|boolean',
        ]);
        $tipo->update($validated);
        return redirect()->back()->with('success', 'Tipo actualizado correctamente');
    }

    public function destroy($id)
    {
        $tipo = \App\Models\Tipo::findOrFail($id);
        $tipo->delete();
        return redirect()->back()->with('success', 'Tipo eliminado correctamente');
    }
}
