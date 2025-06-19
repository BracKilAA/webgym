<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'evaluation_code',
        'user_id',
        'peso',
        'altura',
        'pecho',
        'cintura',
        'cadera',
        'brazo',
        'porcentaje_grasa',
        'fotos',
        'observaciones',
        'evaluated_at',
    ];

    protected $casts = [
        'fotos' => 'array',
        'evaluated_at' => 'datetime',
    ];

    
    public function getImcAttribute()
    {
        if ($this->peso && $this->altura) {
            
            $altura_metros = $this->altura;
            if ($this->altura > 10) { 
                $altura_metros = $this->altura / 100;
            }
            return $this->peso / ($altura_metros * $altura_metros);
        }
        return null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
