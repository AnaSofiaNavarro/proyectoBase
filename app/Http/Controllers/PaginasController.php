<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tipo;
use App\Models\Materia;
use App\Models\Apartado;
use App\Models\Bitacora;
use App\Models\sentencias;
use App\Models\Legislacion;
use App\Models\Publicacione;
use Illuminate\Http\Request;
use App\Models\Configuracion;
use App\Models\Jurisprudencia;
use App\Models\Archivojudicial;
use App\Models\Tipolegislacion;
use App\Models\Tipojurisprudencia;
use App\Models\Validacionconstancia;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PaginasController extends Controller
{


    private function obtenerDatosComunes()
    {
        return [
            'apartados' => Apartado::where('activo', 1)->orderBy('orden', 'asc')->get(),
            'config' => Configuracion::where('activo', 1)->orderBy('idconfiguracion', 'desc')->first(),
            'banner' => true,
        ];
    }

    public function vistaRegistrotitulo()
    {
        $datos = [];
        $seccion = "Registro de Títulos Profesionales";
        return view('registrotitulopje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaConstanciano()
    {
        $datos = [];
        $seccion = "Constancia de No Inhabilitación";
        return view('constancianohabilitacionpje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaDefensoria()
    {
        $datos = [];
        $seccion = "Defensoría Pública";
        return view('defensoriapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaInstituto()
    {
        $convocatorias = Publicacione::where('tipocatalogo_id', 12)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $cursos = Publicacione::where('tipocatalogo_id', 13)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $diplomados = Publicacione::where('tipocatalogo_id', 14)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $resultados = Publicacione::where('tipocatalogo_id', 15)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $peritos = Publicacione::where('tipocatalogo_id', 16)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $gaceta = Publicacione::where('tipocatalogo_id', 17)->where('activo', 1)->orderBy('fecha', 'desc')->get();
        $sentenciaspleno = Publicacione::where('tipocatalogo_id', 18)->where('activo', 1)->get();
        $seccion = "Instituto de Formación Profesionalización y carrera Judicial";
        return view('institutopje', array_merge($this->obtenerDatosComunes(), compact('convocatorias', 'cursos', 'diplomados', 'resultados', 'peritos', 'gaceta', 'sentenciaspleno', 'seccion')));
    }
    public function vistaMejora()
    {
        $datos = [];
        $seccion = "Mejora Regulatoria";
        return view('mejoraregulatoriapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaArchivo()
    {
        $normatividad = Archivojudicial::where('activo', 1)->where('tipocatalogo_id', 9)->orderBy('fecha', 'desc')->get();
        $formatos = Archivojudicial::where('activo', 1)->where('tipocatalogo_id', 10)->orderBy('fecha', 'desc')->get();
        $informes = Archivojudicial::where('activo', 1)->where('tipocatalogo_id', 11)->orderBy('fecha', 'desc')->get();
        $seccion = "Archivo Judicial";
        // dd($normatividad);
        return view('archivojudicialpje', array_merge($this->obtenerDatosComunes(), compact('seccion', 'normatividad', 'formatos', 'informes')));
    }
    public function vistaContraloria()
    {
        $datos = [];
        $seccion = "Contraloria Interna";
        return view('contraloriainternapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaCometica()
    {
        $datos = [];
        $seccion = "Comisión de Ética del Consejo de la Judicatura del Estado";
        return view('cometicapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vistaSentencia()
    {
        $seccion = "Versiones Públicas";
        $materias = DB::connection('mysql_transparencia')->table('cat_materias')->where('activo', 1)->get();
        // $sentencias = Sentencias::where('cat_materias.id_materia', '<>', 1) // Especifica la tabla
        //     ->where('cat_materias.portal', 1)
        //     ->where('cat_materias.activo', 1)
        //     // ->where('cat_materias.id_materia', 2)
        //     ->whereHas('archivos', function ($query) {
        //         $query->where('proc_archivos_anexos.activo', 1); // Especifica la tabla
        //     })
        //     ->whereHas('delitos', function ($query) {
        //         $query->where('cat_delitos.activo', 1)->where('portal', 1);
        //     })
        //     ->with(['areas', 'delitos', 'archivos'])
        //     ->get();


        // $sentencias = Sentencias::where('id_materia', '<>', 1) // Especifica la tabla

        //     ->with(['areas'])
        //     ->get()->toArray();

        // $sentencias = Sentencias::with(['areas' => function ($query) {
        //     $query->selectRaw('id_area, fk_materia, CAST(descripcion AS CHAR) as descripcion');
        // }])->get();

        // foreach ($sentencias as $sentencia) {

        //     $sentencia->areas = $sentencia->areas->pluck('descripcion');
        //     dd($sentencia->areas);
        // }
        // dd($sentencias->toArray());
        // $sentencias = Sentencias::with('areas')->get();


        return view('versionespublicaspje', array_merge($this->obtenerDatosComunes(), compact('materias', 'seccion')));
    }
    function vistaValidaconstancia()
    {
        $datos = [];
        $seccion = "Validación de Constancia de NO antecedentes Penales";
        return view('validaconstanciapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }

    public function buscarconstancia(Request $request)
    {
        $seccion = "Validación de Constancia de NO antecedentes Penales";
        try {
            $datos = [];
            if ($request->has('CO')) {
                // $datos = Validacionconstancia::where('cadena_original', $request->CO)->first();
                $datos = Validacionconstancia::join('ws_usuarios', 'ws_consulta.fk_usuario_ws', '=', 'ws_usuarios.id_usuario')
                    ->whereRaw("REPLACE(cadena_original, '.', ' ') = ?", $request->CO)
                    ->get();
                // dd($datos);
            } else {

                $datos = Validacionconstancia::join('ws_usuarios', 'ws_consulta.fk_usuario_ws', '=', 'ws_usuarios.id_usuario')
                    ->where('folio', $request->clave)
                    ->whereRaw("CAST(TRIM(CONVERT(CONCAT(nombre_consulta, ' ', paterno_consulta, ' ', materno_consulta) USING utf8)) AS BINARY) = ?", $request->nombrecompleto)
                    ->where('foliopago', $request->folio)
                    ->get();
            }
        } catch (\Throwable $th) {
            return view('validaconstanciapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
        }
        // dd($datos);
        return view('validaconstanciapje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }

    public function vistaNopenales()
    {
        $datos = [];
        $seccion = "Expedición de Constancia de No Antecedentes Penales";
        return view('NoAntecedentesPenalespje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }



    public function vistaSentenciagenero()
    {
        $seccion = "Observatorio de Sentencias con Perspectiva de Género";
        // $datos = DB::connection('mysql_transparencia')->table('proc_archivos_anexos')->where('activo', 1)->where('perspectiva_genero', 1)->get();
        // $datos = DB::connection('mysql_transparencia')
        //     ->table('proc_archivos_anexos')
        //     ->join('cat_delitos', 'proc_archivos_anexos.fk_delito', '=', 'cat_delitos.id_delito')
        //     ->where('proc_archivos_anexos.activo', 1)
        //     ->where('proc_archivos_anexos.perspectiva_genero', 1)
        //     ->select('proc_archivos_anexos.*', 'cat_delitos.descripcion as delito')
        //     ->get();
        $datos = DB::connection('mysql_transparencia')
            ->table('proc_archivos_anexos')
            ->join('cat_delitos', 'proc_archivos_anexos.fk_delito', '=', 'cat_delitos.id_delito')
            ->join('cat_areas', 'proc_archivos_anexos.fk_area', '=', 'cat_areas.id_area')
            ->join('cat_materias', 'proc_archivos_anexos.fk_materia', '=', 'cat_materias.id_materia')
            ->where('proc_archivos_anexos.activo', 1)
            ->where('proc_archivos_anexos.perspectiva_genero', 1)
            ->select(
                'proc_archivos_anexos.*',
                'cat_delitos.descripcion as delito',
                'cat_areas.descripcion as area',
                'cat_materias.descripcion as materia'
            )
            ->get();
        // dd($datos);
        return view('sentenciasperspectivageneropje', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
    public function vista200anios()
    {
        $datos = [];
        $seccion = "200 Años de Justicia en Chiapas";
        return view('celebracion200', array_merge($this->obtenerDatosComunes(), compact('datos', 'seccion')));
    }
}
