<?php

use App\Http\Controllers\ComitesController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\FasePropuestasController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\SedesController;
use App\Http\Controllers\UsuariosController;
use App\Models\CronogramaGrupo;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//usuarios
Route::get('/UsuariosUser/index', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('/UsuariosUser/edit/{numeroDocumento}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/UsuariosUser/update/{numeroDocumento}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::post('/UsuariosUser/cambioEstado/{numeroDocumento}',[UsuariosController::class,'cambioEstado'])->name('usuarios.cambioEstado');
Route::post('/UsuariosUser/destroy/{numeroDocumento}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/UsuariosUser/restore/one/{numeroDocumento}', [UsuariosController::class, 'restore'])->name('usuarios.restore');

//sedes
Route::get('/sedes/index', [SedesController::class, 'index'])->name('sedes.index');
Route::post('/sedes/edit/{id}', [SedesController::class, 'edit'])->name('sedes.edit');

//facultades

Route::get('/facultades/index/{id}', [FacultadesController::class, 'index'])->name('facultades.index');
Route::post('/facultades/store/{id}', [FacultadesController::class, 'store'])->name('facultades.store');

//proyectos
Route::get('/proyectos/index', [ProyectosController::class, 'index'])->name('proyecto.index');
Route::get('/proyectos/create', [ProyectosController::class, 'create'])->name('proyecto.create');

//comites
Route::get('/comites/index', [ComitesController::class, 'index'])->name('comite.index');
Route::get('/comites/create', [ComitesController::class, 'create'])->name('comite.create');
Route::post('/comites/edit', [ComitesController::class, 'edit'])->name('comite.edit');

//cronograma
Route::get('/cronograma/index', [CronogramaController::class, 'index'])->name('cronograma.index');
Route::get('/grupos/create', [CronogramaController::class, 'create'])->name('grupo.create');
Route::get('/grupos/edit/{id}', [CronogramaController::class, 'edit'])->name('grupo.edit');
Route::post('/grupos/update/{id}', [CronogramaController::class, 'update'])->name('grupo.update');


//propuesta
Route::get('/propuestas/index', [FasePropuestasController::class, 'index'])->name('propuesta.index');
Route::get('/propuestas/create', [FasePropuestasController::class, 'create'])->name('propuesta.create');
Route::post('/propuestas/store', [FasePropuestasController::class, 'store'])->name('propuesta.store');
Route::get('/propuestas/edit', [FasePropuestasController::class, 'edit'])->name('propuesta.edit');



