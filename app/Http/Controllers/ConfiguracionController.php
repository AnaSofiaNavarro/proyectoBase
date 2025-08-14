<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Models\Configuracion;
use App\Models\Bitacora;

class ConfiguracionController extends Controller
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
    public function index()
    {
        $this->authorize('viewAny', Configuracion::class);

        $usuario = auth()->user()->id;
        $numero = Configuracion::where('activo', 1)->count();

        if ($numero == 0) {
            $this->authorize('create', Configuracion::class);

            return view('configuraciones.crear');
        } else {
            $id = Configuracion::where('activo', 1)->value('idconfiguracion');
            $modelo = Configuracion::findOrFail($id);
            $this->authorize('update', $modelo);

            $dato = Configuracion::findOrFail($id);

            return view('configuraciones.editar', compact('dato'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('create', Configuracion::class);

        $request->validate([
            'nombre' => 'required',
            'imagen' => 'mimes:jpeg,jpg,png,svg',
            'imagenc' => 'mimes:jpeg,jpg,png,svg',
            'imagencalendario' => 'mimes:jpeg,jpg,png,svg'
        ]);


        $usuario = auth()->user()->id;

        $nuevo = new Configuracion();
        if ($request->hasFile('imagen')) {
            $archivo = $request->file('imagen');
            $nombre = 'SGG-' . time();
            $extension = $request->file('imagen')->extension();
            $archivo->move(public_path() . '/storage/configuraciones/', $nombre . '.' . $extension);
            $nuevo->imagen = $nombre . '.' . $extension;
        }
        if ($request->hasFile('imagenc')) {
            $archivoc = $request->file('imagenc');
            $nombrec = 'SGG-' . time();
            $extensionc = $request->file('imagenc')->extension();
            $archivoc->move(public_path() . '/storage/configuraciones/', $nombrec . '.' . $extensionc);
            $nuevo->imagenc = $nombrec . '.' . $extensionc;
        }
        if ($request->hasFile('imagencalendario')) {
            $archivocal = $request->file('imagencalendario');
            $nombrecalendario = 'PJE-' . time();
            $extensioncal = $request->file('imagencalendario')->extension();
            $archivocal->move(public_path() . '/storage/configuraciones/', $nombrecalendario . '.' . $extensioncal);
            $nuevo->imagencalendario = $nombrecalendario . '.' . $extensioncal;
        }
        $nuevo->nombre = $request->input('nombre');
        $nuevo->descripcion = $request->input('descripcion');
        $nuevo->descripcionen = $request->input('descripcionen');
        $nuevo->telefonoprincipal = $request->input('telefonoprincipal');
        $nuevo->telefonosecundario = $request->input('telefonosecundario');
        $nuevo->correoprincipal = $request->input('correoprincipal');
        $nuevo->correosecundario = $request->input('correosecundario');
        $nuevo->buzon = $request->input('buzon');
        $nuevo->prefijo = $request->input('prefijo');
        $nuevo->whatsapp = $request->input('whatsapp');
        $nuevo->facebook = $request->input('facebook');
        $nuevo->instagram = $request->input('instagram');
        $nuevo->twitter = $request->input('twitter');
        $nuevo->youtube = $request->input('youtube');
        $nuevo->tiktok = $request->input('tiktok');
        $nuevo->pagina = $request->input('pagina');
        $nuevo->latitud = $request->input('latitud');
        $nuevo->longitud = $request->input('longitud');
        $nuevo->direccion = $request->input('direccion');
        $nuevo->activo = 1;
        $nuevo->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = auth()->user()->id;
        $bitacora->operacion = 'Configuración agregada con id:' . $nuevo->idconfiguracion;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return view('/home');
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
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = Configuracion::findOrFail($id);
        $this->authorize('update', $modelo);

        $request->validate([
            'nombre' => 'required',
            'imagen' => 'mimes:jpeg,jpg,png,svg',
            'imagenc' => 'mimes:jpeg,jpg,png,svg',
            'imagencalendario' => 'mimes:jpeg,jpg,png,svg',
        ]);

        $actualiza = Configuracion::findOrFail($id);
        if ($request->hasFile('imagen')) {
            if ($actualiza->imagen) {
                $imagenborrar = public_path() . '/storage/configuraciones/' . $actualiza->imagen;
                if (File::exists($imagenborrar)) {
                    unlink($imagenborrar);
                }
            }
            $archivo = $request->file('imagen');
            $nombre = 'SGG-' . time();
            $extension = $request->file('imagen')->extension();
            $archivo->move(public_path() . '/storage/configuraciones/', $nombre . '.' . $extension);
            $actualiza->imagen = $nombre . '.' . $extension;
        }
        if ($request->hasFile('imagenc')) {
            if ($actualiza->imagenc) {
                $imagenborrarc = public_path() . '/storage/configuraciones/' . $actualiza->imagenc;
                if (File::exists($imagenborrarc)) {
                    unlink($imagenborrarc);
                }
            }
            $archivoc = $request->file('imagenc');
            $nombrec = 'SGG-' . time();
            $extensionc = $request->file('imagenc')->extension();
            $archivoc->move(public_path() . '/storage/configuraciones/', $nombrec . '.' . $extensionc);
            $actualiza->imagenc = $nombrec . '.' . $extensionc;
        }
        if ($request->hasFile('imagencalendario')) {
            if ($actualiza->imagencalendario) {
                $imagenborrarcalendario = public_path() . '/storage/configuraciones/' . $actualiza->imagencalendario;
                if (File::exists($imagenborrarcalendario)) {
                    unlink($imagenborrarcalendario);
                }
            }
            $archivocalendario = $request->file('imagencalendario');
            $nombrecalendario = 'PJE-' . time();
            $extensioncalendario = $request->file('imagencalendario')->extension();
            $archivocalendario->move(public_path() . '/storage/configuraciones/', $nombrecalendario . '.' . $extensioncalendario);
            $actualiza->imagencalendario = $nombrecalendario . '.' . $extensioncalendario;
        }
        $actualiza->nombre = $request->input('nombre');
        $actualiza->descripcion = $request->input('descripcion');
        $actualiza->descripcionen = $request->input('descripcionen');
        $actualiza->telefonoprincipal = $request->input('telefonoprincipal');
        $actualiza->telefonosecundario = $request->input('telefonosecundario');
        $actualiza->correoprincipal = $request->input('correoprincipal');
        $actualiza->correosecundario = $request->input('correosecundario');
        $actualiza->buzon = $request->input('buzon');
        $actualiza->prefijo = $request->input('prefijo');
        $actualiza->whatsapp = $request->input('whatsapp');
        $actualiza->facebook = $request->input('facebook');
        $actualiza->instagram = $request->input('instagram');
        $actualiza->twitter = $request->input('twitter');
        $actualiza->youtube = $request->input('youtube');
        $actualiza->tiktok = $request->input('tiktok');
        $actualiza->pagina = $request->input('pagina');
        $actualiza->latitud = $request->input('latitud');
        $actualiza->longitud = $request->input('longitud');
        $actualiza->direccion = $request->input('direccion');
        $actualiza->busqueda_activa = $request->has('busqueda_activa');
        $actualiza->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = auth()->user()->id;
        $bitacora->operacion = 'Configuración editada con id:' . $id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return view('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     //
    // }
}