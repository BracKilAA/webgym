<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ejercicio extends Model
{
    protected $fillable = ['nombre', 'descripcion', 'dificultad'];

    public function planes(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_ejercicio');
 
   }

   protected $table = 'ejercicios';

}