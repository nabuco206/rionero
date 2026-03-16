<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'tbl_proyectos';
    protected $fillable = [
        'codigo',
        'nombre',
        'id_comuna',
        'supervisor_1',
        'supervisor_2',
        'nmro_beneficiarios',
        'nmro_resolucion',
        'fecha_resolucion',
        'fecha_ini_obra',
        'fecha_vencimiento',
        'id_programa',
        'color',
        'estado',
    ];

    public function comuna()
    {
        return $this->belongsTo(Comuna::class, 'id_comuna');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'id_programa');
    }
    
    public function archivos()
    {
        return $this->hasMany(Archivo::class, 'id_proyecto');
    }

    public function calendarios()
    {
        return $this->hasMany(Calendario::class, 'id_proyecto');
    }
}


