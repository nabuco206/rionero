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
}
