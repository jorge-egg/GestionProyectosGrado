<?php

use App\Http\Controllers\ComitesController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\FasePropuestasController;
use App\Http\Controllers\ObservacionesPropuestaController;
use App\Http\Controllers\PonderadosController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\SedeProgramaController;
use App\Http\Controllers\SedesController;
use App\Http\Controllers\UsuariosController;
use App\Models\CronogramaGrupo;
use App\Models\ObservacionesCalificacione;
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
Route::get('get-programas-by-sede/{sedeId}', [UsuariosController::class, 'getProgramasBySede']);
Route::get('/UsuariosUser/index', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::post('/UsuariosUser/edit/{numeroDocumento}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/UsuariosUser/update/{numeroDocumento}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::post('/UsuariosUser/cambioEstado/{numeroDocumento}',[UsuariosController::class,'cambioEstado'])->name('usuarios.cambioEstado');
Route::post('/UsuariosUser/destroy/{numeroDocumento}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/UsuariosUser/restore/one/{numeroDocumento}', [UsuariosController::class, 'restore'])->name('usuarios.restore');

//sedes
Route::get('/sedes/index', [SedesController::class, 'index'])->name('sedes.index');
Route::post('/sedes/edit/{id}', [SedesController::class, 'edit'])->name('sedes.edit');
Route::post('/sedes/store', [SedesController::class, 'store'])->name('sedes.store');

//facultades

Route::get('/facultades/index/{id}', [FacultadesController::class, 'index'])->name('facultades.index');
Route::post('/facultades/store/{id}', [FacultadesController::class, 'store'])->name('facultades.store');

//proyectos
Route::get('/proyectos/index', [ProyectosController::class, 'index'])->name('proyecto.index');
Route::get('/proyectos/indextable', [ProyectosController::class, 'indextable'])->name('proyecto.indextable');
Route::get('/proyectos/indextableAll', [ProyectosController::class, 'indextableAll'])->name('proyecto.indextableAll');
Route::post('/proyectos/create/{integrantes}', [ProyectosController::class, 'create'])->name('proyecto.create');
Route::get('/usuario/consulta', [ProyectosController::class, 'buscarIntegrante'])->name('buscarIntegrante');

//comites
Route::get('comite/integrantes/create', [ComitesController::class, 'createIntegrante'])->name('comite.integrantes.create');
Route::post('comite/integrantes/store', [ComitesController::class, 'storeIntegrante'])->name('comite.integrantes.store');
Route::get('/comites/index', [ComitesController::class, 'index'])->name('comite.index');
Route::get('/comites/create', [ComitesController::class, 'create'])->name('comite.create');
Route::post('/comites/edit', [ComitesController::class, 'edit'])->name('comite.edit');
Route::post('/comites/update/{idComite}', [ComitesController::class, 'update'])->name('comite.update');
Route::post('/comites/destroy/{idComite}', [ComitesController::class, 'destroy'])->name('comite.destroy');
Route::get('/comites/restore/one/{idComite}', [ComitesController::class, 'restore'])->name('comite.restore');

//programas
Route::get('/programas/index/{id}', [SedeProgramaController::class, 'index'])->name('programas.index');
Route::get('/programas/create/{id}', [SedeProgramaController::class, 'create'])->name('programas.create');
Route::post('/programas/store/{id}', [SedeProgramaController::class, 'store'])->name('programas.store');
Route::post('/programas/edit/{idPrograma}', [SedeProgramaController::class, 'edit'])->name('programa.edit');
Route::post('/programas/update/{idPrograma}', [SedeProgramaController::class, 'update'])->name('programa.update');
Route::post('/programas/destroy/{idPrograma}', [SedeProgramaController::class, 'destroy'])->name('programa.destroy');
Route::get('/programas/restore/one/{idPrograma}', [SedeProgramaController::class, 'restore'])->name('programa.restore');

//cronograma
Route::get('/cronograma/index', [CronogramaController::class, 'index'])->name('cronograma.index');
Route::get('/grupos/create', [CronogramaController::class, 'create'])->name('grupo.create');
Route::get('/grupos/edit/{id}', [CronogramaController::class, 'edit'])->name('grupo.edit');
Route::post('/grupos/update/{id}', [CronogramaController::class, 'update'])->name('grupo.update');


//propuesta
Route::get('/propuestas/index', [FasePropuestasController::class, 'index'])->name('propuesta.index');
Route::post('/propuestas/create/{idProyecto}', [FasePropuestasController::class, 'create'])->name('propuesta.create');
Route::post('/propuestas/store', [FasePropuestasController::class, 'store'])->name('propuesta.store');
Route::get('/propuestas/edit', [FasePropuestasController::class, 'edit'])->name('propuesta.edit');
Route::post('/propuestas/createAnterior', [FasePropuestasController::class, 'createAnterior'])->name('propuesta.createAnterior');

//ponderados
Route::get('/ponderados/index', [PonderadosController::class, 'index'])->name('ponderados.index');


//observaciones
Route::post('/observaciones/store', [ObservacionesPropuestaController::class, 'store'])->name('observaciones.store');
Route::post('/observaciones/update', [ObservacionesPropuestaController::class, 'update'])->name('observaciones.update');
