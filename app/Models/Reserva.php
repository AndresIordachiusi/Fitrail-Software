<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        "client_id",
        "entrenamiento_id",
        "estado",
        "fecha_reserva"
    ];

    public function cliente(){
        return $this->belongsTo(Client::class, "client_id");
    }

    public function entrenamiento(){
        return $this->belongsTo(Entrenamiento::class, "entrenamiento_id");
    }
}
