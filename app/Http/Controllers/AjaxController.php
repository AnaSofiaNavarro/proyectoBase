<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seccion;
use App\Models\Configuracion;
use App\Models\Municipio;
use App\Models\Vmunicipio;
use App\Models\Directorio;
use App\Models\Vdirectorio;

class AjaxController extends Controller
{
    public function cargasecciones(Request $request, $id)
    {
        if($request->ajax())
        {
            $secciones = Seccion::where('fkapartado', $id)->orderBy('idseccion', 'asc')->get();
            return response()->json($secciones);
        }
    }

    public function cargaterminositio(Request $request)
    {
        if($request->ajax())
        {
            $terminositio = Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->limit(1)->value('termino');
            return response()->json($terminositio);
        }
    }

    public function cargaorden(Request $request, $id)
    {
        if($request->ajax())
        {
            $numero = Seccion::where('fkapartado', $id)->count();
            $numero = $numero + 1;
            return response()->json($numero);
        }
    }

    public function mapamunicipios(Request $request, $id)
    {
        if($request->ajax())
        {
            if($id > 0) {
                $poligonos = Vmunicipio::where([['idmunicipio', $id], ['activo', 1]])->orderBy('municipio', 'asc')->get();
            }
            else {
                $poligonos = Vmunicipio::where('activo', 1)->orderBy('municipio', 'asc')->get();
            }
            return response()->json($poligonos);
        }
    }

    public function ordendirectorio(Request $request, $id)
    {
        if($request->ajax())
        {
            if($id == 0) {
                $numero = Directorio::whereNull('fkpadre')->count();
            }
            else {
                $numero = Directorio::where('fkpadre', $id)->count();
            }          
            $numero = $numero + 1;
            return response()->json($numero);
        }
    }
}