<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class User extends Authenticatable // 
{
    use HasFactory;

    protected $fillable = [
        'user_code',
        'nombre',
        'email',
        'telefono',
        'fecha_inscripcion',
        'objetivo',
        'observaciones',
        'tipo',
        'password'
    ];

    protected $dates = ['fecha_inscripcion'];

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }

    public function evaluations()
    {
        return $this->hasMany(Evaluation::class);
    }

    public function getProgresoAttribute()
    {
        $planesCompletados = $this->plans()->where('completado', true)->count();
        $totalPlanes = $this->plans()->count();
        
        return $totalPlanes > 0 ? round(($planesCompletados / $totalPlanes) * 100) : 0;
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($user) {
            $lastUser = self::orderBy('id', 'desc')->first();
            $nextId = $lastUser ? $lastUser->id + 1 : 1;
            $user->user_code = 'CLI-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
        });
    }
}
