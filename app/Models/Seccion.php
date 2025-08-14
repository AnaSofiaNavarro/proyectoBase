<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Seccion extends Model
{
    use HasFactory;

    protected $table = 'secciones';
    protected $primaryKey = 'idseccion';
    //By CIRG para deshabilitar los campos created_at y updated_at
    // public $timestamps = false;

    public function getSeccionAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->seccionen;
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

public function usuarios()
{
    return $this->belongsToMany(User::class, 'seccion_usuario', 'fkseccion', 'fkusuario');
}



    public function getDescripcionAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->descripcionen;
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