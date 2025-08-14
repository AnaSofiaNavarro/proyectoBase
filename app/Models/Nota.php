<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    public function scopeBusqueda($query, $busqueda)
    {
        if ($busqueda) {
            return $query->where('titulo', 'like', "%$busqueda%");
        }
    }
}
