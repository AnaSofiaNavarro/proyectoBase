<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Tipo;
use App\Models\Contenidoanexo;
use App\Models\Bitacora;
use Image;
use Carbon\Carbon;

class ContenidoanexoController extends Controller
{
    //By CIRG - Protejer la ruta.
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    // }

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
        if($request->tipo == 1)
        {
            $request->validate([
                'tipo' => 'required',
                'anexo' => 'required|mimes:jpeg,jpg,png'
            ]);
        }
        elseif($request->tipo == 2)
        {
            $request->validate([
                'tipo' => 'required',
                'anexo' => 'required|mimes:mp4|max:200000'
            ]);
        }
        elseif($request->tipo == 3)
        {
            $request->validate([
                'tipo' => 'required',
                'anexo' => 'required|mimes:pdf',
                'descripcion' => 'required'
            ]);
        }
        elseif($request->tipo == 4)
        {
            $request->validate([
                'tipo' => 'required',
                'url' => 'required' 
            ]);
        }

        $anexo = new Contenidoanexo();
        $anexo->fecha = Carbon::now()->toDateString();
        $anexo->fkcontenido = $request->input('fkcontenido');
        $anexo->fktipo = $request->input('tipo');
        if($request->hasFile('anexo')) {
            $archivo = $request->file('anexo');
            $nombre = 'VT-'.time();
            $extension = $request->file('anexo')->extension();
            $archivo->move(public_path().'/storage/anexos/', $nombre.'.'.$extension);
            if($request->tipo == 1) {
                // ini_set('memory_limit', '-1');
                // $ruta = public_path().'/storage/anexos/'.$nombre.'.'.$extension;
                // $rutasave = public_path().'/storage/anexos/'.$nombre.'.jpg';

                // $image = Image::make($ruta);
                // $image = $image->encode('jpg', 85);
                // $altura = $image->height();
                // $ancho = $image->width();

                // if($ancho > $altura)
                // {
                //     if($ancho < 1440)
                //     {
                //         $image->widen(1440, null, function($constraint){
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //         })->save($rutasave, 85);
                //     }
                //     else
                //     {
                //         $image->resize(1440, null, function($constraint){
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //         })->save($rutasave, 85);
                //     }
                // }
                // elseif($altura >= $ancho)
                // {
                //     if ($altura < 810)
                //     {
                //         $image->heighten(810, null, function($constraint){
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //         })->save($rutasave, 85);
                //     }
                //     else
                //     {
                //         $image->resize(null, 810, function($constraint){
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //         })->save($rutasave, 85);
                //     }
                // }

                // $imagesave = Image::make($rutasave);
                // $alturasave = $imagesave->height();
            
                // if ($alturasave <= 810)
                // {
                //     $img = Image::canvas(1440, 810);
                //     $img->fill('#FFFFFF');
                //     $img->insert($rutasave, 'center');
                //     $img->save($rutasave, 85);
                // }

                // if(File::exists($ruta))
                // {
                //     if($extension != 'jpg')
                //     {
                //         unlink($ruta);
                //     }
                // }
    
                $anexo->imagen = $nombre.'.'.$extension;
                $anexo->descripcion = $request->input('descripcion');
            }
            elseif($request->tipo == 2) {
                $anexo->video = $nombre.'.'.$extension;
            }
            elseif($request->tipo == 3) {
                $anexo->archivo = $nombre.'.'.$extension;
                $anexo->descripcion = $request->input('descripcion');
            }
        }
        $anexo->url = $request->input('url');

        if(isset($request->activo)) {
            $anexo->activo = 1;
        }
        else {
            $anexo->activo = 0;
        }
        $anexo->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = auth()->user()->id;
        $bitacora->operacion = 'Anexo agregado con id:'.$anexo->idanexo.' del contenido con id:'.$anexo->fkcontenido;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return back()->with('mensaje', '¡Anexo agregado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $page = $request->input('page');
        $vfecha = $request->input('vfecha');
        $vapartado = $request->input('vapartado');
        $vseccion = $request->input('vseccion');
        $vbusqueda = $request->input('vbusqueda');

        $datos = Contenidoanexo::where('fkcontenido',$id)->orderBy('idanexo','asc')->get();

        $tipos = Tipo::where('anexo',1)->orderBy('idtipo','asc')->get();
        
        return view('contenidoanexos.lista',compact('page','vfecha','vapartado','vseccion','vbusqueda','id','tipos','datos'));   
    }

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
        $actualiza = Contenidoanexo::findOrFail($id);
        if(isset($request->activo)) {
            $actualiza->activo = 1;
        }
        else {
            $actualiza->activo = 0;
        }
        $actualiza->save();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = auth()->user()->id;
        if(isset($request->activo)) {
            $bitacora->operacion = 'Anexo público con id:'.$id;
        }
        else {
            $bitacora->operacion = 'Anexo privado con id:'.$id;
        }
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        if(isset($request->activo)) {
            return back()->withInput()->with('mensaje', '¡Anexo público correctamente!');
        }
        else {
            return back()->withInput()->with('mensaje', '¡Anexo privado correctamente!');
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
        $anexo="";
        $elimina = Contenidoanexo::findOrFail($id);
        if($elimina->fktipo == 1) {
            $anexo = public_path().'/storage/anexos/'.$elimina->imagen;
        }
        elseif($elimina->fktipo == 2) {
            $anexo = public_path().'/storage/anexos/'.$elimina->video;
        }
        elseif($elimina->fktipo == 3) {
            $anexo = public_path().'/storage/anexos/'.$elimina->archivo;
        }
        if(file_exists($anexo)) {
            unlink($anexo);
        }
        $elimina->delete();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = auth()->user()->id;
        $bitacora->operacion = 'Anexo eliminado con id:'.$id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return back()->with('mensaje', '¡Anexo eliminado correctamente!');
    }
}