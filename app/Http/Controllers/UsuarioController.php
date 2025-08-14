<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Juzgado;
use App\Models\Bitacora;
use App\Models\Seccion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
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
        $this->authorize('viewAny', User::class);

        $page = $request->page;
        $vbusqueda = $request->vbusqueda;

        $usuarios = User::busqueda($vbusqueda)->orderBy('name', 'asc')->paginate(10);
        $numero = User::busqueda($vbusqueda)->orderBy('name', 'asc')->count();


        return view('usuarios.lista', compact('page', 'vbusqueda', 'usuarios', 'numero',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', User::class);

        if ($request->ajax()) {
            $roles = Role::where('id', $request->role_id)->first();
            $permissions = $roles->permissions;
            return $permissions;
        }

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');
        $juzgados = Juzgado::where('activo', 1)->get();
        $roles = Role::all();
        $secciones = Seccion::all();


        return view('usuarios.crear', compact('page', 'vbusqueda', 'roles', 'juzgados','secciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all()); 
        $this->authorize('create', User::class);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|unique:users|max:250',
            'contraseña' => 'required|confirmed',
            'contraseña_confirmation' => 'required',
        ]);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $nuevousuario = new User();
        $nuevousuario->name = $request->input('nombre');
        $nuevousuario->tel = $request->input('telefono');
        $nuevousuario->email = $request->input('email');
        if ($request->contraseña != null) {
            $nuevousuario->password = Hash::make($request->input('contraseña'));
        }
        $nuevousuario->nota = $request->input('nota');
        if (isset($request->activo)) {
            $nuevousuario->activo = 1;
        } else {
            $nuevousuario->activo = 0;
        }
        $nuevousuario->save();

        if ($request->role != null) {
            $nuevousuario->roles()->attach($request->input('role'));
            $nuevousuario->save();
        }

        if ($request->permissions != null) {
            foreach ($request->permissions as $item) {
                $nuevousuario->permissions()->attach($item);
                $nuevousuario->save();
            }
        }

                    if ($request->has('secciones') && is_array($request->secciones)) {
        $nuevousuario->secciones()->sync($request->secciones);
    }


        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Usuario agregado con id:' . $nuevousuario->id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return redirect('/usuarios?page=' . $page . '&vbusqueda=' . $vbusqueda)->with('mensaje', '¡Usuario agregado correctamente!');
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
        $modelo = User::findOrFail($id);
        $this->authorize('update', $modelo);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $usuarios = User::findOrFail($id);
        $roles = Role::all();
        $usuariorole = $usuarios->roles->first();
        if ($usuariorole != null) {
            $rolepermisos = $usuariorole->allRolePermissions;
        } else {
            $rolepermisos = null;
        }
        $usuariopermisos = $usuarios->permissions;
        $secciones = Seccion::all();
        $seccionesSeleccionadas = $usuarios->secciones->pluck('idseccion')->toArray();



        return view('usuarios.editar', compact('page', 'vbusqueda', 'roles', 'usuariorole', 'rolepermisos', 'usuariopermisos', 'usuarios', 'secciones','seccionesSeleccionadas'));
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
        $modelo = User::findOrFail($id);
        $this->authorize('update', $modelo);

        $request->validate([
            'nombre' => 'required',
            'email' => 'required|unique:users,email,' . $id . ',id|max:250',
            'contraseña' => 'confirmed',
        ]);

        $page = $request->input('page');
        $vbusqueda = $request->input('vbusqueda');

        $actualizausuario  = User::findOrFail($id);
        $actualizausuario->name = $request->input('nombre');
        $actualizausuario->tel = $request->input('telefono');
        $actualizausuario->email = $request->input('email');
        if ($request->contraseña != null) {
            $actualizausuario->password = Hash::make($request->input('contraseña'));
        }
        $actualizausuario->nota = $request->input('nota');
        if (isset($request->activo)) {
            $actualizausuario->activo = 1;
        } else {
            $actualizausuario->activo = 0;
        }
        $actualizausuario->save();

        $actualizausuario->roles()->detach();
        $actualizausuario->permissions()->detach();

        if ($request->role != null) {
            $actualizausuario->roles()->attach($request->input('role'));
            $actualizausuario->save();
        }

        if ($request->permissions != null) {
            foreach ($request->permissions as $item) {
                $actualizausuario->permissions()->attach($item);
                $actualizausuario->save();
            }
        }

            // ✅ Actualizar secciones
    if ($request->has('secciones') && is_array($request->secciones)) {
        $actualizausuario->secciones()->sync($request->secciones);
    } else {
        // Si no se envía nada, quitamos todas
        $actualizausuario->secciones()->detach();
    }

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Usuario editado con id:' . $id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return redirect('/usuarios?page=' . $page . '&vbusqueda=' . $vbusqueda)->with('mensaje', '¡Usuario editado correctamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $modelo = User::findOrFail($id);
        $this->authorize('delete', $modelo);

        $eliminausuario = User::findOrFail($id);
        $eliminausuario->roles()->detach();
        $eliminausuario->permissions()->detach();
        $eliminausuario->delete();

        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Usuario eliminado con id:' . $id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();

        return back()->withInput()->with('mensaje', '¡Usuario eliminado correctamente!');
    }

    public function changePassword(Request $request)
    {
        $page = $request->input('page');
        return view('usuarios.cambiarpass', compact('page'));

        // $request->validate([
        //     'password' => 'confirmed',
        //     'new_password' => 'required|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        // ]);
        // $user = User::find(Auth::user()->id);
        // $user->password = Hash::make($request->new_password);
        // $user->save();
    }
    function updatepassword(Request $request)
    {


        $request->validate([
            'password' => 'required|min:8',
            'new_password' => 'required|min:8',
        ]);
        $user = User::find(Auth::user()->id);

        $user->password = Hash::make($request->new_password);
        $user->save();


        $bitacora = new Bitacora();
        $bitacora->fkusuario = Auth::user()->id;
        $bitacora->operacion = 'Usuario modificado contraseña con id:' . $user->id;
        $bitacora->fecha = Carbon::now()->toDateTimeString();
        $bitacora->ip = $request->ip();
        $bitacora->pc = gethostname();
        $bitacora->save();



        return redirect('/home')->with('mensaje', 'Contraseña actualizada correctamente.');
    }
}