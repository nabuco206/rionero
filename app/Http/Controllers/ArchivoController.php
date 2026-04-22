<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivo;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ArchivoController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'id_tipo' => 'required|exists:tbl_tipos,id',
            'id_proyecto' => 'required|exists:tbl_proyectos,id',
            'archivo' => [
                'required',
                'file',
                'max:10240', // 10MB
                function (string $attribute, $value, $fail) {
                    $blockedExtensions = [
                        'exe', 'bat', 'cmd', 'com', 'msi', 'scr', 'pif',
                        'sh', 'ps1', 'vbs', 'jar', 'wsf',
                    ];

                    $blockedMimeTypes = [
                        'application/x-msdownload',
                        'application/x-dosexec',
                        'application/x-msdos-program',
                        'application/x-bat',
                        'application/x-sh',
                        'text/x-shellscript',
                        'application/x-powershell',
                    ];

                    $extension = strtolower((string) $value->getClientOriginalExtension());
                    $mimeType = strtolower((string) $value->getMimeType());

                    if (in_array($extension, $blockedExtensions, true) || in_array($mimeType, $blockedMimeTypes, true)) {
                        $fail('Este tipo de archivo está bloqueado por seguridad.');
                    }
                },
            ],
        ], [
            'archivo.required' => 'Debes seleccionar un archivo.',
            'archivo.file' => 'El archivo seleccionado no es válido.',
            'archivo.uploaded' => 'El archivo no se pudo subir al servidor. Verifica tamaño máximo permitido en servidor (upload_max_filesize/post_max_size).',
            'archivo.max' => 'El archivo no puede superar los 10MB.',
        ], [
            'archivo' => 'archivo',
            'id_tipo' => 'tipo',
            'id_proyecto' => 'proyecto',
        ]);

        $archivoSubido = $request->file('archivo');
        if (!$archivoSubido || !$archivoSubido->isValid()) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'msg' => 'Archivo inválido.'], 422);
            }

            return redirect()->back()->withErrors(['archivo' => 'Archivo inválido.'])->withInput();
        }

        $path = null;

        try {
            $path = $archivoSubido->store('archivos', 'public');

            Archivo::create([
                'nombre' => $validated['nombre'],
                'id_tipo' => $validated['id_tipo'],
                'id_proyecto' => $validated['id_proyecto'],
                'path' => $path,
                'estado' => true,
            ]);
        } catch (Throwable $e) {
            if ($path && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }

            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'msg' => 'No se pudo guardar el archivo.'], 500);
            }

            return redirect()->back()->withErrors(['archivo' => 'No se pudo guardar el archivo.'])->withInput();
        }

        if ($request->ajax() || $request->expectsJson()) {
            return response()->json(['success' => true, 'msg' => 'Archivo guardado correctamente']);
        }

        return redirect()->back()->with('success', 'Archivo guardado correctamente');
    }
}
