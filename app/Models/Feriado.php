<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    protected $fillable = [
        'nombre',
        'fecha',
        'es_recuperable',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'date',
        'es_recuperable' => 'boolean',
        'estado' => 'boolean',
    ];
}
