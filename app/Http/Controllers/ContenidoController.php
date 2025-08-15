<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Apartado;
use App\Models\Seccion;
use App\Models\Contenido;
use App\Models\Contenidoanexo;
use App\Models\Vcontenido;
use App\Models\Vista;
use App\Models\Tipocontenido;
use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;


class ContenidoController extends Controller
{
    // By CIRG - Protejer la ruta.
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $this->authorize('viewAny', Vcontenido::class);

    $user = Auth::user();

    $page = $request->input('page');
    $vfecha = $request->input('vfecha');
    $vapartado = $request->input('vapartado');
    $vseccion = $request->input('vseccion');
    $vbusqueda = $request->input('vbusqueda');

    // Secciones autorizadas
    if($user->roles->contains('slug','administrador')){
        // Apartados (todos)
        $apartados = Apartado::orderBy('orden', 'asc')->get();

        // Secciones filtradas por apartado (si se seleccionó uno)
        $secciones = Seccion::when($vapartado, fn($q) => $q->where('fkapartado', $vapartado))
            ->orderBy('orden', 'asc')
            ->get();

        // Contenidos (todos)
        $datos = Vcontenido::fecha($vfecha)
            ->apartado($vapartado)
            ->seccion($vseccion)
            ->busqueda($vbusqueda)
            ->orderByDesc('fecha')
            ->orderByDesc('idcontenido')
            ->paginate(20);

        $numero = Vcontenido::fecha($vfecha)
            ->apartado($vapartado)
            ->seccion($vseccion)
            ->busqueda($vbusqueda)
            ->count();
    
    
    } else{
        $seccionesAutorizadas = $user->secciones()->pluck('idseccion')->toArray();

    // Apartados con secciones autorizadas
    $apartados = Apartado::whereIn('idapartado', function ($query) use ($seccionesAutorizadas) {
        $query->select('fkapartado')
              ->from('secciones')
              ->whereIn('idseccion', $seccionesAutorizadas);
    })
    ->orderBy('orden', 'asc')
    ->get();

    // Secciones filtradas por apartado (si se seleccionó uno)
    $secciones = Seccion::whereIn('idseccion', $seccionesAutorizadas)
        ->when($vapartado, fn($q) => $q->where('fkapartado', $vapartado))
        ->orderBy('orden', 'asc')
        ->get();

    // Contenidos visibles en secciones autorizadas
    $datos = Vcontenido::whereIn('fkseccion', $seccionesAutorizadas)
        ->fecha($vfecha)
        ->apartado($vapartado)
        ->seccion($vseccion)
        ->busqueda($vbusqueda)
        ->orderByDesc('fecha')
        ->orderByDesc('idcontenido')
        ->paginate(20);

    $numero = Vcontenido::whereIn('fkseccion', $seccionesAutorizadas)
        ->fecha($vfecha)
        ->apartado($vapartado)
        ->seccion($vseccion)
        ->busqueda($vbusqueda)
        ->count();
    }
    

    return view('contenidos.lista', compact('page', 'vfecha', 'vapartado', 'vseccion', 'vbusqueda', 'apartados', 'secciones', 'datos', 'numero'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create(Request $request)
{
    $this->authorize('create', Vcontenido::class);

    $page = $request->input('page');
    $vfecha = $request->input('vfecha');
    $vapartado = $request->input('vapartado');
    $vseccion = $request->input('vseccion');
    $vbusqueda = $request->input('vbusqueda');

    $apartados = Apartado::where([['menu', false], ['enlace', false]])
                        ->orderBy('orden', 'asc')->get();

    $user = Auth::user();

    $templatePath = resource_path('views\templates');
    $templateFiles = File::files($templatePath);

    $templates = [];
    foreach ($templateFiles as $file) {
        $filename = $file->getFilenameWithoutExtension();
        $templates[] = $filename;
    }

    if ($user->roles->contains('slug', 'administrador')) {
        $secciones = Seccion::where('enlace', false)->orderBy('orden', 'asc')->get();
        $isAdmin = true;
    } else {
        $secciones = $user->secciones()->where('enlace', false)->orderBy('orden', 'asc')->get();
        $isAdmin = false;
    }

    $tipocontenidos = Tipocontenido::where('activo', true)
                            ->orderBy('idtipocontenido', 'asc')->get();

    return view('contenidos.crear', compact(
        'page', 'vfecha', 'vapartado', 'vseccion', 'vbusqueda',
        'apartados', 'secciones', 'tipocontenidos', 'isAdmin',
        'templates'
    ));
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Vcontenido::class);

        if(isset($request->vista)) {
            $request->validate([
                'fecha' => 'required',
                'seccion' => 'required',
                'encabezado' => 'required|max:250',
                'slug' => 'required|unique:contenidos|max:250',
                'tipocontenido' => 'required',
                'archivo' => 'mimes:jpeg,jpg,png,pdf,doc,docx,mp4'
            ]);
        }
        else {
            $request->validate([
                'fecha' => 'required',
                'apartado' => 'required',
                'encabezado' => 'required|max:250',
                'slug' => 'required|unique:contenidos|max:250',
                'tipocontenido' => 'required',
                'archivo' => 'mimes:jpeg,jpg,png,pdf,doc,docx,mp4'
            ]);
        }
        
        $nuevo = new Contenido();
        $nuevo->fecha = Carbon::createFromFormat('d/m/Y', $request->input('fecha'))->toDateString();
        $nuevo->encabezado = $request->input('encabezado');
        $nuevo->encabezadoen = $request->input('encabezadoen');
        $nuevo->slug = $request->input('slug');
        $nuevo->subtitulo = $request->input('subtitulo');
        $nuevo->subtituloen = $request->input('subtituloen');
        $nuevo->descripcion = $request->input('descripcion');
        $nuevo->descripcionen = $request->input('descripcionen');
        $nuevo->fuente = $request->input('fuente');
        $nuevo->telefono = $request->input('telefono');
        $nuevo->extension = $request->input('extension');
        $nuevo->correo = $request->input('correo');
        $nuevo->fktipocontenido = $request->input('tipocontenido');
        $nuevo->template = $request->input('template');
        if($request->input('tipocontenido') == 1) {
            $nuevo->archivo = null;
            $nuevo->url = null;
        }
        elseif ($request->input('tipocontenido') == 2) {
            if($request->hasFile('archivo'))
            {
                $archivo = $request->file('archivo');
                $nombre = 'SGG-'.time();
                $extension = $request->file('archivo')->extension();
                $archivo->move(public_path().'/storage/anexos/', $nombre.'.'.$extension);
                $nuevo->archivo = $nombre.'.'.$extension;
            }    
            $nuevo->url = null;
        }
        elseif ($request->input('tipocontenido') == 3) {
            $nuevo->archivo = null;
            $nuevo->url = $request->input('url');
        }
        if(isset($request->target)) {
            $nuevo->target = 1;
        }
        else {
            $nuevo->target = 0;
        }
        if(isset($request->relevante)) {
            $nuevo->relevante = 1;
        }
        else {
            $nuevo->relevante = 0;
        }
        if(isset($request->activo)) {
            $nuevo->activo = 1;
        }
        else {
            $nuevo->activo = 0;
        }
        $nuevo->save();

        if(isset($request->vista)) {
            if(!empty($request->seccion)) {
                foreach ($request->seccion as $itemseccion) {
                    $nuevavista = new Vista();
                    $nuevavista->fkcontenido = $nuevo->idcontenido;
                    $nuevavista->fkapartado = Seccion::where('idseccion',$itemseccion)->value('fkapartado');
                    $nuevavista->fkseccion = $itemseccion; 
                    $nuevavista->save();
                }
            }
        }
        else {
            $nuevavista = new Vista();
            $nuevavista->fkcontenido = $nuevo->idcontenido;
            $nuevavista->fkapartado = $request->input('apartado');
            $nuevavista->save();
        }

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Contenido agregado con id:'.$nuevo->idcontenido;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return redirect('/contenidos?page='.$request->page.'&vfecha='.$request->vfecha.'&vapartado='.$request->vapartado.'&vseccion='.$request->vseccion.'&vbusqueda='.$request->vbusqueda)->with('mensaje','¡Contenido agregado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $modelo = Vcontenido::findOrFail($id);
        $this->authorize('update',$modelo);

        $page = $request->input('page');
        $vfecha = $request->input('vfecha');
        $vapartado = $request->input('vapartado');
        $vseccion = $request->input('vseccion');
        $vbusqueda = $request->input('vbusqueda');

        $datos = Contenido::findOrFail($id);

        // $apartados = Apartado::where([['menu',0]])->orderBy('apartado','asc')->get();
        // $secciones = Seccion::orderBy('seccion','asc')->get();
        $apartados = Apartado::where([['menu', false], ['enlace', false]])->orderBy('orden', 'asc')->get();
        $secciones = Seccion::where([['enlace', false]])->orderBy('orden', 'asc')->get();
        $datosecciones = Vista::where('fkcontenido',$id)->get();
        $tipocontenidos = Tipocontenido::where('activo',true)->orderBy('idtipocontenido','asc')->get();

        $templatePath = resource_path('views\templates');
        $templateFiles = File::files($templatePath);

        $templates = [];
        foreach ($templateFiles as $file) {
            $filename = $file->getFilenameWithoutExtension();
            $templates[] = $filename;
        }
        
        if(count($datosecciones) == 1) {
            if($datosecciones->contains('fkseccion', null)) {
                $vista = 'A';
            }
            else {
                $vista = 'S';
            }
        }
        else {
            $vista = 'S';
        }
        
        return view('contenidos.editar',compact('page','vfecha','vapartado','vseccion','vbusqueda','vista','apartados','secciones','datosecciones','datos','tipocontenidos','templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = Vcontenido::findOrFail($id);
        $this->authorize('update',$modelo);
        
        if(isset($request->vista))
        {
            $request->validate([
                'fecha' => 'required',
                'seccion' => 'required',
                'encabezado' => 'required|max:250',
                'slug' => 'required|unique:contenidos,slug,'.$id.',idcontenido|max:250',
                'tipocontenido' => 'required',
                'archivo' => 'mimes:jpeg,jpg,png,pdf,doc,docx,mp4'
            ]);
        }
        else
        {
            $request->validate([
                'fecha' => 'required',
                'apartado' => 'required',
                'encabezado' => 'required|max:250',
                'slug' => 'required|unique:contenidos,slug,'.$id.',idcontenido|max:250',
                'tipocontenido' => 'required',
                'archivo' => 'mimes:jpeg,jpg,png,pdf,doc,docx,mp4'
            ]);
        }

        $actualiza = Contenido::findOrFail($id);
        $actualiza->fecha = Carbon::createFromFormat('d/m/Y', $request->input('fecha'))->toDateString();
        $actualiza->encabezado = $request->input('encabezado');
        $actualiza->encabezadoen = $request->input('encabezadoen');
        $actualiza->slug = $request->input('slug');
        $actualiza->subtitulo = $request->input('subtitulo');
        $actualiza->subtituloen = $request->input('subtituloen');
        $actualiza->descripcion = $request->input('descripcion');
        $actualiza->descripcionen = $request->input('descripcionen');
        $actualiza->fuente = $request->input('fuente');
        $actualiza->telefono = $request->input('telefono');
        $actualiza->extension = $request->input('extension');
        $actualiza->correo = $request->input('correo');
        $actualiza->fktipocontenido = $request->input('tipocontenido');
        $actualiza->template = $request->input('template');
        if($request->input('tipocontenido') == 1) {
            $actualiza->archivo = null;
            $actualiza->url = null;
        }
        elseif ($request->input('tipocontenido') == 2) {
            if ($request->hasFile('archivo')) {
                if($actualiza->archivo) {
                    $archivoborrar = public_path().'/storage/anexos/'.$actualiza->archivo;
                    if (File::exists($archivoborrar)) {
                        unlink($archivoborrar);
                    }
                }
                $archivo = $request->file('archivo');
                $nombre = 'SGG-'.time();
                $extension = $request->file('archivo')->extension();
                $archivo->move(public_path().'/storage/anexos/', $nombre.'.'.$extension);
                $actualiza->archivo = $nombre.'.'.$extension;
            }    
            $actualiza->url = null;
        }
        elseif ($request->input('tipocontenido') == 3) {
            $actualiza->archivo = null;
            $actualiza->url = $request->input('url');
        }
        if(isset($request->target)) {
            $actualiza->target = 1;
        }
        else {
            $actualiza->target = 0;
        }        
        if(isset($request->relevante)) {
            $actualiza->relevante = 1;
        }
        else {
            $actualiza->relevante = 0;
        }
        if(isset($request->activo)) {
            $actualiza->activo = 1;
        }
        else {
            $actualiza->activo = 0;
        }
        $actualiza->save();

        $eliminavistas = Vista::where('fkcontenido', $id);
        $eliminavistas->delete();

        if(isset($request->vista)) {
            if(!empty($request->seccion)) {
                foreach ($request->seccion as $itemseccion) {
                    $nuevavista = new Vista();
                    $nuevavista->fkcontenido = $id;
                    $nuevavista->fkapartado = Seccion::where('idseccion', $itemseccion)->value('fkapartado');
                    $nuevavista->fkseccion = $itemseccion; 
                    $nuevavista->save();
                }
            }
        }
        else {
            $nuevavista = new Vista();
            $nuevavista->fkcontenido = $id;
            $nuevavista->fkapartado = $request->apartado;
            $nuevavista->save();
        }

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Contenido editado con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return redirect('/contenidos?page='.$request->page.'&vfecha='.$request->vfecha.'&vapartado='.$request->vapartado.'&vseccion='.$request->vseccion.'&vbusqueda='.$request->vbusqueda)->with('mensaje','¡Nota editada correctamente!');
    }

    public function estatus(Request $request, $id)
    {
        $modelo = Vcontenido::findOrFail($id);
        $this->authorize('update',$modelo);
        
        $actualiza = Contenido::findOrFail($id);
        if(isset($request->activo)) {
            $actualiza->activo = 1;
        }
        else {
            $actualiza->activo = 0;
        }
        $actualiza->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        if(isset($request->activo)) {
            $bitacora->operacion = 'Contenido activo con id:'.$id;
        }
        else {
            $bitacora->operacion = 'Contenido inactivo con id:'.$id;
        }
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        if(isset($request->activo)) {
            return back()->withInput()->with('mensaje', '¡Contenido activo correctamente!');
        }
        else {
            return back()->withInput()->with('mensajenegativo', '¡Contenido inactivo correctamente!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $modelo = Vcontenido::findOrFail($id);
        $this->authorize('delete',$modelo);

        $eliminavista = Vista::where('fkcontenido',$id);
        $eliminavista->delete();
        
        foreach (Contenidoanexo::where('fkcontenido',$id)->cursor() as $anexocursor)
        {
            if($anexocursor->imagen) {
                $imagenborrar = public_path().'/storage/anexos/'.$anexocursor->imagen;
                if(File::exists($imagenborrar)) {
                    unlink($imagenborrar);
                }
            }
            if($anexocursor->video) {
                $videoborrar = public_path().'/storage/anexos/'.$anexocursor->video;
                if(File::exists($videoborrar)) {
                    unlink($videoborrar);
                }
            }
            if($anexocursor->archivo) {
                $archivoborrar = public_path().'/storage/anexos/'.$anexocursor->archivo;
                if(File::exists($archivoborrar)) {
                    unlink($archivoborrar);
                }
            }
            $anexocursor->delete();    
        }
        
        $eliminar = Contenido::findOrFail($id);
        if($eliminar->archivo) {
            $archivoborrar = public_path().'/storage/anexos/'.$eliminar->archivo;
            if(File::exists($archivoborrar)) {
                unlink($archivoborrar);
            }
        }
        $eliminar->delete();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Contenido eliminado con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return back()->withInput()->with('mensaje', '¡Contenido eliminado correctamente!');
    }
}