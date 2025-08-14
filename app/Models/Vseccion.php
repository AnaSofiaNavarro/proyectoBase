<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vseccion extends Model
{
    use HasFactory;

    protected $table = 'vsecciones';
    protected $primaryKey = 'idseccion';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;

    public function scopeBusqueda($query, $busqueda)
    {
        if($busqueda)
        {
            return $query->where('seccion', 'like', "%$busqueda%")->orWhere('apartado', 'like', "%$busqueda%");
        }
    }
}
