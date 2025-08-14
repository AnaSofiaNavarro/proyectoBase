<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vdirectorio extends Model
{
    use HasFactory;

    protected $table = 'vdirectorios';
    protected $primaryKey = 'iddirectorio';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;

    public function scopeBusqueda($query, $busqueda)
    {
        if ($busqueda) {
            return $query->where('nombrecompleto', 'like', "%$busqueda%")->orWhere('area', 'like', "%$busqueda%")->orWhere('adscripcion', 'like', "%$busqueda%");
        }
    }
}
