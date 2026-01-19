<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    protected $table = 'tbl_comunas';
    protected $fillable = [
        'gls_comuna',
        'estado',
    ];
}
