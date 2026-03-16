<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendario extends Model
{
    use HasFactory;

    protected $table = 'tbl_calendario';

    protected $fillable = [
        'id_proyecto',
        'id_tipo',
        'estado',
        'descripcion',
        'fecha',
    ];

    public function proyecto()
    {
        return $this->belongsTo(Proyecto::class, 'id_proyecto');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'id_tipo');
    }
}
