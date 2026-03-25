<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = [
        'nombre',
        'fecha_inicio',
        'fecha_fin',
        'cerrado',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'cerrado' => 'boolean',
        'estado' => 'boolean',
    ];
}
