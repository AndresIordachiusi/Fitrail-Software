<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{

    protected $fillable = [
        "nombre",
        "descripcion",
        "precio",
    ];

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }



}
