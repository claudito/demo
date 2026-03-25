<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $fillable = [
        'codigo',
        'numero_documento',
        'nombres',
        'apellidos',
        'cargo',
        'condicion_laboral',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];
}
