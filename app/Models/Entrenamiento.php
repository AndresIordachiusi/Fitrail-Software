<?php

namespace App\Models; // Model for "entrenamiento"


use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    protected $fillable = [
        "nombre",
        "descripcion",
        "capacidad",
        "fecha_inicio",
        "fecha_fin",
        "entrenador_id",
    ];

    public function entrenador()
    {
        return $this->belongsTo(Entrenador::class);
    }

    public function reserva()
    {
        return $this->hasMany(reserva::class);
    }
}
