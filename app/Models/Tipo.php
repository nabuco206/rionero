<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $table = 'tbl_tipos';
    protected $fillable = [
        'gls_tipo',
        'tipo',
        'estado',
    ];
}
