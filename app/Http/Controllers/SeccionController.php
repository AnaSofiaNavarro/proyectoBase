<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartado;
use App\Models\Seccion;
use App\Models\Vseccion;
use App\Models\Bitacora;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SeccionController extends Controller
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
    $this->authorize('viewAny', Vseccion::class);

    $page = $request->input('page');
    $vbusqueda = $request->input('vbusqueda');

    $user = Auth::user();

    if ($user->roles->contains('slug', 'administrador')) {
        $datos = Vseccion::busqueda($vbusqueda)
            ->orderBy('fkapartado', 'asc')
            ->orderBy('orden', 'asc')
            ->paginate(20);

        $numero = Vseccion::busqueda($vbusqueda)
            ->count();
    } else {
        // Filtrar por secciones permitidas
        $seccionesIds = $user->secciones()->pluck('idseccion');

        $datos = Vseccion::whereIn('idseccion', $seccionesIds)
            ->busqueda($vbusqueda)
            ->orderBy('fkapartado', 'asc')
            ->orderBy('orden', 'asc')
            ->paginate(20);

        $numero = Vseccion::whereIn('idseccion', $seccionesIds)
            ->busqueda($vbusqueda)
            ->count();
    }

    return view('secciones.lista', compact('page', 'vbusqueda', 'datos', 'numero'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create',Vseccion::class);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $apartados = Apartado::where([['menu',true],['enlace',false],['activo',true]])->orderBy('orden','asc')->get();

        return view('secciones.crear',compact('page','vbusqueda','apartados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Vseccion::class);

        $request->validate([
            'seccion' => 'required',
            'slug' => 'required|unique:secciones|max:250',
            'descripcion' => 'required',
            'orden' => 'required'
        ]);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');
        
        $nuevaseccion = new Seccion();
        $nuevaseccion->fkapartado = $request->input('apartado');
        $nuevaseccion->seccion = $request->input('seccion');
        $nuevaseccion->seccionen = $request->input('seccionen');
        $nuevaseccion->slug = $request->input('slug');
        $nuevaseccion->descripcion = $request->input('descripcion');
        $nuevaseccion->descripcionen = $request->input('descripcionen');
        $nuevaseccion->division = $request->input('division');
        $nuevaseccion->orden = $request->input('orden');
        if(isset($request->enlace)) {
            $nuevaseccion->enlace = 1;
            $nuevaseccion->url = $request->input('url');
            if(isset($request->target)) {
                $nuevaseccion->target = 1;
            }
            else {
                $nuevaseccion->target = 0;
            }
        }
        else {
            $nuevaseccion->enlace = 0;
            $nuevaseccion->url = null;
            $nuevaseccion->target = 0;
        }
        if(isset($request->activo)) {
            $nuevaseccion->activo = 1;
        }
        else {
            $nuevaseccion->activo = 0;
        }
        $nuevaseccion->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Sección agregada con id:' . $nuevaseccion->idseccion;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return redirect('/secciones?page='.$page.'&vbusqueda='.$vbusqueda)->with('mensaje','¡Sección agregada correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $modelo = Vseccion::findOrFail($id);
        $this->authorize('update', $modelo);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $secciones = Seccion::findOrFail($id);
        $apartados = Apartado::where([['menu', true], ['enlace', false], ['activo', true]])->orderBy('orden', 'asc')->get();
        $numero = Seccion::where('fkapartado', $secciones->fkapartado)->count();

        return view('secciones.editar',compact('page', 'vbusqueda', 'secciones', 'apartados', 'numero'));
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
        $modelo = Vseccion::findOrFail($id);
        $this->authorize('update', $modelo);

        $request->validate([
            'seccion' => 'required',
            'slug' => 'required|unique:secciones,slug,'.$id.',idseccion|max:250',
            'descripcion' => 'required',
            'orden' => 'required'
        ]);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');
        
        $actualizaseccion = Seccion::findOrFail($id);
        $actualizaseccion->fkapartado = $request->input('apartado');
        $actualizaseccion->seccion = $request->input('seccion');
        $actualizaseccion->seccionen = $request->input('seccionen');
        $actualizaseccion->slug = $request->input('slug');
        $actualizaseccion->descripcion = $request->input('descripcion');
        $actualizaseccion->descripcionen = $request->input('descripcionen');
        $actualizaseccion->division = $request->input('division');
        $actualizaseccion->orden = $request->input('orden');
        if(isset($request->enlace))
        {
            $actualizaseccion->enlace = 1;
            $actualizaseccion->url = $request->input('url');
            if(isset($request->target))
            {
                $actualizaseccion->target = 1;
            }
            else
            {
                $actualizaseccion->target = 0;
            }
        }
        else
        {
            $actualizaseccion->enlace = 0;
            $actualizaseccion->url = null;
            $actualizaseccion->target = 0;
        }
        if(isset($request->activo))
        {
            $actualizaseccion->activo = 1;
        }
        else
        {
            $actualizaseccion->activo = 0;
        }
        $actualizaseccion->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Sección editada con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return redirect('/secciones?page='.$page.'&vbusqueda='.$vbusqueda)->with('mensaje','¡Sección editada correctamente!');
    }

    public function estatus(Request $request, $id)
    {
        $modelo = Vseccion::findOrFail($id);
        $this->authorize('update', $modelo);
        
        $actualiza = Seccion::findOrFail($id);
        if(isset($request->activo))
        {
            $actualiza->activo = 1;
        }
        else
        {
            $actualiza->activo = 0;
        }
        $actualiza->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        if(isset($request->activo))
        {
            $bitacora->operacion = 'Sección activa con id:'.$id;
        }
        else
        {
            $bitacora->operacion = 'Sección inactiva con id:'.$id;
        }
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        if(isset($request->activo))
        {
            return back()->withInput()->with('mensaje', '¡Sección activa correctamente!');
        }
        else
        {
            return back()->withInput()->with('mensajenegativo', '¡Sección inactiva correctamente!');
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
        $modelo = Vseccion::findOrFail($id);
        $this->authorize('delete', $modelo);

        $eliminaseccion = Seccion::findOrFail($id);
        $eliminaseccion->delete();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Sección eliminada con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return back()->withInput()->with('mensaje', '¡Sección eliminada correctamente!');
    }
}