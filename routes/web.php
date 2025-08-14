<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IniController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Inicio de Administración.

Auth::routes();


Route::group(
    ['middleware' => 'auth'],
    function () {
        Route::resource('/configuraciones', 'App\Http\Controllers\ConfiguracionController');
        Route::resource('/configuracionanexos', 'App\Http\Controllers\ConfiguracionanexoController');

        Route::resource('/apartados', 'App\Http\Controllers\ApartadoController');
        Route::put('/apartados/{apartado}/estatus', 'App\Http\Controllers\ApartadoController@estatus');

        Route::resource('/secciones', 'App\Http\Controllers\SeccionController');
        Route::put('/secciones/{seccion}/estatus', 'App\Http\Controllers\SeccionController@estatus');
        Route::get('/secciones/orden/{idapartado}', 'App\Http\Controllers\AjaxController@cargaorden');

        Route::resource('/contenidos', 'App\Http\Controllers\ContenidoController');
        Route::put('/contenidos/{contenido}/estatus', 'App\Http\Controllers\ContenidoController@estatus');
        Route::get('/contenidos/secciones/{idapartado}', 'App\Http\Controllers\AjaxController@cargasecciones');
        Route::resource('/contenidoanexos', 'App\Http\Controllers\ContenidoanexoController');

        Route::resource('/roles', 'App\Http\Controllers\RoleController');
        Route::resource('/usuarios', 'App\Http\Controllers\UsuarioController');
        Route::get('/cambiarpass', 'App\Http\Controllers\UsuarioController@changePassword')->name('cambiarpass');
        Route::post('/usuarios/updatepassword', [UsuarioController::class, 'updatepassword'])->name('usuarios.updatepassword');

        Route::get('/set_language/{lang}', [App\Http\Controllers\Controller::class, 'set_language'])->name('set_language');

    }
);
Route::get('/buscar', [BuscadorController::class, 'buscar'])->name('busqueda.general');
Route::get('/ajax/seccion/{slug}/filtrar', [IniController::class, 'filtrarContenidos'])->name('seccion.filtrar');
Route::get('/ajax/apartado/{slug}/filtrar', [IniController::class, 'filtrarContenidosApartado'])->name('apartado.filtrar');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [IniController::class, 'index']);
Route::get('/apartado/{apartado}', [IniController::class, 'apartado']);
Route::get('/seccion/{seccion}', [IniController::class, 'seccion']);
Route::get('/apartado/{apartado}/{contenido}', [IniController::class, 'acontenido']);
Route::get('/seccion/{seccion}/{contenido}', [IniController::class, 'scontenido']);


Route::get('/register', function () {
    return redirect('/');
})->name('register');

Auth::routes(['register' => false]); // ❌ Desactiva el registro