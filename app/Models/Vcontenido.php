<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Vcontenido extends Model
{
    use HasFactory;

    protected $table = 'vcontenidos';
    protected $primaryKey = 'idcontenido';
    //By CIRG para deshabilitar los campos created_at y updated_at
    public $timestamps = false;

    public function scopeFecha($query, $fecha)
    {
        if($fecha)
        {
            $fechaformat = date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));
            return $query->where('fecha', '=', $fechaformat);
        }
    }

    public function scopeApartado($query, $apartado)
    {
        if($apartado)
        {
            return $query->where('fkapartado', $apartado);
        }
    }


    public function scopeSeccion($query, $seccion)
    {
        if($seccion)
        {
            return $query->where('fkseccion', $seccion);
        }
    }

    public function scopeBusqueda($query, $busqueda)
    {
        if($busqueda)
        {
            return $query->where('encabezado', 'like', "%$busqueda%");
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

    public function getEncabezadoAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->encabezadoen;
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

    public function getSubtituloAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->subtituloen;
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

    public function getNotaAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->notaen;
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
        // En App\Models\Vcontenido.php
    public function scopeBuscarTitulo($query, $titulo)
    {
        if (!empty($titulo)) {
            $query->where('encabezado', 'LIKE', '%' . $titulo . '%');
        }
    }

    public function getTemplate($valor){
        $Locale = App::getLocale();
        if($Locale == 'es'){
            return $valor;
        }
    }

}