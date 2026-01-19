<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'tbl_archivos';
    protected $fillable = [
        'nombre',
        'path',
        'estado',
    ];
}
