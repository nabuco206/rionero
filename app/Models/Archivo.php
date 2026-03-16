<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'tbl_archivos';
    protected $fillable = [
        'nombre',
        'path',
        'id_tipo',
        'id_proyecto',
        'estado',
    ];

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }
}
