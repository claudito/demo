<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $fillable = [
        'nombre',
        'hora_entrada',
        'hora_salida',
        'tolerancia_minutos',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
