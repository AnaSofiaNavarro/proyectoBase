<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Apartado extends Model
{
    use HasFactory;

    protected $table = 'apartados';
    protected $primaryKey = 'idapartado';
    //By CIRG para deshabilitar los campos created_at y updated_at
    // public $timestamps = false;

    public function scopeBusqueda($query, $busqueda)
    {
        if($busqueda)
        {
            return $query->where('apartado', 'like', "%$busqueda%");
        }
    }

    public function getApartadoAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->apartadoen;
        $traduccion = Str::of($traduccion)->trim();
        $len = Str::length($traduccion);

        if($traduccion AND $len > 0)
        {
            return $traduccion;
        }
        else
        {
            return $valor;
        }
    }
}
