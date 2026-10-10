<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $fillable = [
        'direccion',
        'telefono',
        'ciudad',
        'horario_apertura',
        'horario_cierre',
    ];

    public function Entrenadores()
    {
        return $this->hasMany(Entrenador::class);
    }
}
