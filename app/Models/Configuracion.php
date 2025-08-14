<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Configuracion extends Model
{
    use HasFactory;

    protected $table = 'configuraciones';
    protected $primaryKey = 'idconfiguracion';
    //By CIRG para deshabilitar los campos created_at y updated_at
    // public $timestamps = false;

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

    public function getTexto1Attribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->texto1en;
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

    public function getTexto2Attribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->texto2en;
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

    public function getTexto3Attribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->texto3en;
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

    public function getTexto4Attribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->texto4en;
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

    public function getVideotituloAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->videotituloen;
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

    public function getVideosubtituloAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->videosubtituloen;
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

    public function getVideoenlacedescripcionAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->videoenlacedescripcionen;
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

    public function getTextotestimonioAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->textotestimonioen;
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

    public function getAvisoAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->avisoen;
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

    public function getTerminoAttribute($valor)
    {
        $locale = App::getLocale();

        if($locale == 'es')
        {
            return $valor;
        }

        $traduccion = $this->terminoen;
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