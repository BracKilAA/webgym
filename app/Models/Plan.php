<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'descripcion',
        'duracion_semanas',
        'sesiones_semana',
        'fecha_inicio',
        'ejercicios',
        'completado'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
