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
        'fecha',
        'id_programa',
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
   
}


