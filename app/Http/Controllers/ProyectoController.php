<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::with(['comuna', 'programa'])->get();
        return view('proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        $comunas = \App\Models\Comuna::all();
        $programas = \App\Models\Programa::all();
        return view('proyectos.create', compact('comunas', 'programas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->reglas(), $this->mensajes());
        Proyecto::create($validated);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente');
    }

    public function edit($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $comunas = \App\Models\Comuna::all();
        $programas = \App\Models\Programa::all();
        return view('proyectos.edit', compact('proyecto', 'comunas', 'programas'));
    }

    public function update(Request $request, $id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $validated = $request->validate($this->reglas($proyecto->id), $this->mensajes());
        $proyecto->update($validated);
        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente');
    }
    /**
     * Reglas de validación para store y update
     */
    private function reglas($id = null)
    {
        return [
            'codigo' => 'required|unique:tbl_proyectos,codigo' . ($id ? ',' . $id : ''),
            'nombre' => 'required|string',
            'id_comuna' => 'required|exists:tbl_comunas,id',
            'supervisor_1' => 'nullable|string',
            'supervisor_2' => 'nullable|string',
            'nmro_beneficiarios' => 'required|integer',
            'nmro_resolucion' => 'nullable|string',
            'fecha_resolucion' => 'nullable|date',
            'fecha_ini_obra' => 'nullable|date',
            'fecha_vencimiento' => 'nullable|date',
            'id_programa' => 'required|exists:tbl_programas,id',
            'estado' => 'required|in:0,1',
            'color' => 'nullable|in:rojo,amarillo,celeste',
        ];
    }

    /**
     * Mensajes de validación personalizados
     */
    private function mensajes()
    {
        return [
            'codigo.unique' => 'El código ya existe en la base de datos.',
            'codigo.required' => 'El campo código es obligatorio.',
            'nombre.required' => 'El campo nombre es obligatorio.',
            'id_comuna.required' => 'Debe seleccionar una comuna.',
            'id_programa.required' => 'Debe seleccionar un programa.',
            'nmro_beneficiarios.required' => 'Debe ingresar el número de beneficiarios.',
            'fecha.required' => 'Debe ingresar la fecha.',
        ];
    }

    public function destroy($id)
    {
        $proyecto = Proyecto::findOrFail($id);
        $proyecto->delete();
        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente');
    }
}
