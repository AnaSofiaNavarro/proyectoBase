<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Apartado;
Use App\Models\Bitacora;
Use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ApartadoController extends Controller
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
        $this->authorize('viewAny',Apartado::class);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $datos = Apartado::busqueda($vbusqueda)->orderBy('activo', 'desc')->orderBy('orden', 'asc')->paginate(20);
        $numero = Apartado::busqueda($vbusqueda)->orderBy('activo', 'desc')->orderBy('orden', 'asc')->count();
    
        return view('apartados.lista',compact('page','vbusqueda','datos','numero')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create',Apartado::class);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $numero = Apartado::count();

        return view('apartados.crear',compact('page','vbusqueda','numero'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create',Apartado::class);

        $request->validate([
            'apartado' => 'required',
            'slug' => 'required|unique:apartados|max:50',
            'orden' => 'required'
        ]);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');
        
        $nuevo = new Apartado();
        $nuevo->apartado = $request->input('apartado');
        $nuevo->apartadoen = $request->input('apartadoen');
        $nuevo->slug = $request->input('slug');
        $nuevo->orden = $request->input('orden');
        if(isset($request->enlace)) {
            $nuevo->enlace = 1;
            $nuevo->url = $request->input('url');
            if(isset($request->target)) {
                $nuevo->target = 1;
            }
            else {
                $nuevo->target = 0;
            }
        }
        else {
            $nuevo->enlace = 0;
            $nuevo->url = null;
            $nuevo->target = 0;
        }
        if(isset($request->menu)) {
            $nuevo->menu = 1;
        }
        else {
            $nuevo->menu = 0;
        }
        if(isset($request->activo)) {
            $nuevo->activo = 1;
        }
        else {
            $nuevo->activo = 0;
        }
        $nuevo->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Apartado agregado con id:'.$nuevo->idapartado;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return redirect('/apartados?page='.$page.'&vbusqueda='.$vbusqueda)->with('mensaje','¡Apartado agregado correctamente!');
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
        $modelo = Apartado::findOrFail($id);
        $this->authorize('update',$modelo);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $numero = Apartado::count();
        $dato = Apartado::findOrFail($id);
        
        return view('apartados.editar',compact('page','vbusqueda','numero','dato'));
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
        $modelo = Apartado::findOrFail($id);
        $this->authorize('update', $modelo);

        $request->validate([
            'apartado' => 'required',
            'slug' => 'required|unique:apartados,slug,'.$id.',idapartado|max:50',
            'orden' => 'required'
        ]);

        $page = $request->page;
        $vbusqueda = $request->vbusqueda;
        
        $actualiza = Apartado::findOrFail($id);
        $actualiza->apartado = $request->input('apartado');
        $actualiza->apartadoen = $request->input('apartadoen');
        $actualiza->slug = $request->input('slug');
        $actualiza->orden = $request->input('orden');
        if(isset($request->enlace)) {
            $actualiza->enlace = 1;
            $actualiza->url = $request->input('url');
            if(isset($request->target)) {
                $actualiza->target = 1;
            }
            else {
                $actualiza->target = 0;
            }
        }
        else {
            $actualiza->enlace = 0;
            $actualiza->url = null;
            $actualiza->target = 0;
        }
        if(isset($request->menu)) {
            $actualiza->menu = 1;
        }
        else {
            $actualiza->menu = 0;
        }
        if(isset($request->activo)) {
            $actualiza->activo = 1;
        }
        else {
            $actualiza->activo = 0;
        }
        $actualiza->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Apartado editado con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return redirect('/apartados?page='.$page.'&vbusqueda='.$vbusqueda)->with('mensaje','¡Apartado editado correctamente!');
    }

    public function estatus(Request $request, $id)
    {
        $modelo = Apartado::findOrFail($id);
        $this->authorize('update', $modelo);
        
        $actualiza = Apartado::findOrFail($id);
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
            $bitacora->operacion = 'Apartado activo con id:'.$id;
        }
        else {
            $bitacora->operacion = 'Apartado inactivo con id:'.$id;
        }
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        if(isset($request->activo)) {
            return back()->withInput()->with('mensaje', '¡Apartado activo correctamente!');
        }
        else {
            return back()->withInput()->with('mensajenegativo', '¡Apartado inactivo correctamente!');
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
        $modelo = Apartado::findOrFail($id);
        $this->authorize('delete', $modelo);

        $elimina = Apartado::findOrFail($id);
        $elimina->delete();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Apartado eliminado con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();
        
        return back()->withInput()->with('mensaje', '¡Apartado eliminado correctamente!');
    }
}