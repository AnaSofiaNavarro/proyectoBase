<?php

namespace App\Http\Controllers;


use App\Models\Nota;
use App\Models\Seccion;
use App\Models\Apartado;
use App\Models\Contenido;
use App\Models\Vcontenido;
use App\Models\Configuracion;
use App\Models\Contenidoanexo;
use Illuminate\Http\Request;



class IniController extends Controller
{
public function filtrarContenidos(Request $request, $slug)
{
    $titulo = $request->input('titulo');

    $consulta = Vcontenido::where([['seccionslug', $slug], ['activo', 1]])
        ->buscarTitulo($titulo)
        ->groupBy('idcontenido')
        ->orderBy('fecha', 'desc')
        ->orderBy('idcontenido', 'desc')
        ->get(); // usamos get() en lugar de paginate

    return view('partials.cards', compact('consulta'));
}

public function filtrarContenidosApartado(Request $request, $slug)
{
    $titulo = $request->input('titulo');

    $consulta = Vcontenido::where([['apartadoslug', $slug], ['activo', 1]])
        ->buscarTitulo($titulo)
        ->groupBy('idcontenido')
        ->orderBy('fecha', 'desc')
        ->orderBy('idcontenido', 'desc')
        ->get();

    return view('partials.cards', ['consulta' => $consulta]);
}

    
    public function index()
    {
        // BASICO.
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = true;

        $relevantes = Vcontenido::where([['relevante', 1], ['activo', 1]])->orderBy('fecha', 'desc')->limit(5)->get();
        $ligas = Vcontenido::where([['fktipocontenido', 3], ['activo', 1]])->inRandomOrder()->limit(8)->get();
        $nota = Nota::where('activo', 1)->orderBy('prioridad', 'desc')->orderBy('fecha', 'desc')->first();
        $c_temp = Contenido::where('slug', 'videos-youtube')->first();
        // dd($avisos);

        return view('inicio', compact('apartados', 'config', 'banner', 'relevantes', 'ligas',));
    }

// Contenidos
public function apartado($apartado,)
{
    // Conteo de contenidos activos en el apartado
    $conteo = Vcontenido::where([['apartadoslug', $apartado], ['activo', 1]])
        ->groupBy('idcontenido')
        ->get();

    // Si no hay contenidos en el apartado
    if ($conteo->isEmpty()) {
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        return view('construccion', compact('apartados', 'config', 'banner'));
    }

    // Si hay solo un contenido
    if ($conteo->count() === 1) {
        $dato = Vcontenido::where([['apartadoslug', $apartado], ['activo', 1]])->first();

        // Si no es tipo contenido único (tipo 1), se listan los relacionados
        if ($dato->fktipocontenido != 1) {
            $datos = Vcontenido::where([['seccionslug', $dato->fkseccion], ['activo', 1]])
                ->groupBy('idcontenido')
                ->orderBy('fecha', 'desc')
                ->orderBy('idcontenido', 'desc')
                ->paginate(9);
        }

        // Carga de datos básicos
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        // Título y sección asociada
        $apartado = Apartado::findOrFail($dato->fkapartado);
        $seccion = $dato->fkseccion ? Seccion::find($dato->fkseccion) : null;

        // Anexos
        $anexos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', '<>', 3], ['activo', 1]])->get();
        $archivos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', 3], ['activo', 1]])->get();

        if ($dato->fktipocontenido == 1) {
            return view('contenido', compact('dato', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'anexos', 'archivos'));
        } else {
            return view('contenidos', compact('datos', 'apartados', 'config', 'banner', 'apartado', 'seccion'));
        }
    }

    // Si hay más de un contenido en el apartado
    if ($conteo->count() > 1) {
        $titulo = request('titulo');
        $query = request('q'); // Captura la palabra buscada desde la URL

        $consulta = Vcontenido::where([['apartadoslug', $apartado], ['activo', 1]]);

        // Si viene 'q', buscar por título usando ese valor
        if (!empty($query)) {
            $consulta = $consulta->buscarTitulo($query);
        } else {
            $consulta = $consulta->buscarTitulo($titulo);
        }

        $datos = $consulta
            ->groupBy('idcontenido')
            ->orderBy('fecha', 'desc')
            ->orderBy('idcontenido', 'desc')
            ->paginate(9);

        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;
        $apartado = Apartado::where('slug', $apartado)->firstOrFail();
        $seccion = null;

        return view('contenidos', compact('datos', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'query'));
    }
}


public function seccion($seccion, Request $request)
{ 
    $query = $request->input('q');

    // Conteo de contenidos activos en la sección
    $conteo = Vcontenido::where([['seccionslug', $seccion], ['activo', 1]])
        ->groupBy('idcontenido')
        ->get();

    // Si no hay contenidos en la sección
    if ($conteo->isEmpty()) {
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        return view('construccion', compact('apartados', 'config', 'banner'));
    }

    // Si hay solo un contenido
    if ($conteo->count() === 1) {
        $dato = Vcontenido::where([['seccionslug', $seccion], ['activo', 1]])->first();

        // Si no es tipo contenido único (tipo 1), se listan los relacionados
        if ($dato->fktipocontenido != 1) {
            $datos = Vcontenido::where([['seccionslug', $seccion], ['activo', 1]])
                ->groupBy('idcontenido')
                ->orderBy('fecha', 'desc')
                ->orderBy('idcontenido', 'desc')
                ->paginate(9);
        }

        // Datos básicos
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        // Título y sección
        $apartado = Apartado::findOrFail($dato->fkapartado);
        $seccion = Seccion::findOrFail($dato->fkseccion);

        // Anexos
        $anexos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', '<>', 3], ['activo', 1]])->get();
        $archivos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', 3], ['activo', 1]])->get();

        if ($dato->fktipocontenido == 1) {
            return view('contenido', compact('dato', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'anexos', 'archivos','query'));
        } else {
            return view('contenidos', compact('datos', 'apartados', 'config', 'banner', 'apartado', 'seccion'));
        }
    }

    // Si hay más de un contenido en la sección
    if ($conteo->count() > 1) {
$titulo = request('titulo');
$query = request('q'); // Captura la palabra buscada desde la URL

$consulta = Vcontenido::where([['seccionslug', $seccion], ['activo', 1]]);

// Si viene 'q', buscar por título usando ese valor
if (!empty($query)) {
    $consulta = $consulta->buscarTitulo($query);
} else {
    $consulta = $consulta->buscarTitulo($titulo);
}

$datos = $consulta
    ->groupBy('idcontenido')
    ->orderBy('fecha', 'desc')
    ->orderBy('idcontenido', 'desc')
    ->paginate(9);

$apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
$config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
$banner = false;

$seccion = Seccion::where('slug', $seccion)->firstOrFail();
$apartado = Apartado::findOrFail($seccion->fkapartado);

return view('contenidos', compact('datos', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'query'));
    }
}


    public function acontenido($apartado, $contenido)
    {
        


        // Dato.
        $dato = Vcontenido::where([['apartadoslug', $apartado], ['contenidoslug', $contenido]])->firstOrFail();

        // Basico.
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        // Título.
        $apartado = Apartado::findOrFail($dato->fkapartado);
        $seccion = null;

        // Anexos
        $anexos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', '<>', 3], ['activo', 1]])->get();
        $archivos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', 3], ['activo', 1]])->get();

        return view('contenido', compact('dato', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'anexos', 'archivos','query'));
    }

    public function scontenido($seccion, $contenido)
    {
$query = request('q'); // Captura la palabra buscada desde la URL

        // Dato.
        $dato = Vcontenido::where([['seccionslug', $seccion], ['contenidoslug', $contenido]])->firstOrFail();

        // Basico.
        $apartados = Apartado::where('activo', 1)->orderBy('orden', 'asc')->get();
        $config = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first();
        $banner = false;

        // Título.
        $apartado = Apartado::findOrFail($dato->fkapartado);
        $seccion = Seccion::findOrFail($dato->fkseccion);

        // Anexos
        $anexos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', '<>', 3], ['activo', 1]])->get();
        $archivos = Contenidoanexo::where([['fkcontenido', $dato->idcontenido], ['fktipo', 3], ['activo', 1]])->get();
        return view('contenido', compact('dato', 'apartados', 'config', 'banner', 'apartado', 'seccion', 'anexos', 'archivos', 'query'));
    }
}