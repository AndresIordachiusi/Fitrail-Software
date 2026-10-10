<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    public function plans()
    {
        return $this->belongsToMany(Plan::class)
        ->withPivot('fecha_inicio', 'fecha_fin', 'estado'); // Relación muchos a muchos con la tabla intermedia 'client_plan' y campos adicionales
    }
    public function reserva()
    {
        return $this->hasMany(Reserva::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class); // 1:1
    }

    public function seguimientos()
    {
        return $this->hasMany(Seguimiento::class);
    }

    protected $fillable = [ //campos que se pueden asignar 
        'nombre',
        "apellido",
        'email',
        'edad',
        'altura',
        'peso',
        'objetivo',
        'user_id'
    ];

}
