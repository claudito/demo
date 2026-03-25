<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    protected $fillable = [
        'nombre',
        'hora_inicio',
        'hora_fin',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
