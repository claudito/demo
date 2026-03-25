<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoBoleta extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
