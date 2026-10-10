<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $fillable = [
        'client_id',
        'entrenador_id',
        'fecha_seguimiento',
        'peso',
        'altura',
        'imc',
        'nivel_energia',
        'adherencia',
        'progreso',
        'observaciones',
        'proximos_pasos',
    ];

    protected $casts = [
        'fecha_seguimiento' => 'date',
        'peso' => 'decimal:2',
        'altura' => 'decimal:2',
        'imc' => 'decimal:2',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function entrenador()
    {
        return $this->belongsTo(Entrenador::class);
    }
}
