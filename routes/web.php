<?php

use App\Http\Controllers\bibliotecaController;
use App\Models\FasePropuesta;
use App\Traits\FaseSustentacion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SedesController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ComitesController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\ProyectosController;
use App\Http\Controllers\CronogramaController;
use App\Http\Controllers\FacultadesController;
use App\Http\Controllers\PonderadosController;
use App\Http\Controllers\SedeProgramaController;
use App\Http\Controllers\FasePropuestasController;

use App\Http\Controllers\FaseAnteproyectosController;


use App\Http\Controllers\FaseProyectoFinalController;
use App\Http\Controllers\ObservacionesPropuestaController;

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

//charts
Route::get('/charts/index', [ChartsController::class, 'index'])->name('charts.index');

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

Route::get('/facultades/index', [FacultadesController::class, 'index'])->name('facultades.index');
Route::post('/facultades/store/{id}', [FacultadesController::class, 'store'])->name('facultades.store');
Route::get('/facultades/edit/{idSede}/{idFacultad}', [FacultadesController::class, 'edit'])->name('facultades.edit');
Route::post('/facultades/update/{idFacultad}/{idSede}', [FacultadesController::class, 'update'])->name('facultades.update');
Route::post('/facultades/destroy/{idFacultad}/{idSede}', [FacultadesController::class, 'destroy'])->name('facultades.destroy');

//proyectos
Route::get('/proyectos/index', [ProyectosController::class, 'index'])->name('proyecto.index');
Route::get('/proyectos/indextable', [ProyectosController::class, 'indextable'])->name('proyecto.indextable');
Route::get('/proyectos/indextableAll', [ProyectosController::class, 'indextableAll'])->name('proyecto.indextableAll');
Route::get('/proyectos/indextableComite', [ProyectosController::class, 'indextableComite'])->name('proyecto.indextableComite');
Route::get('/proyectos/indextableJurado', [ProyectosController::class, 'indextableJurado'])->name('proyecto.indextableJurado');
Route::get('/proyectos/indextableDocente', [ProyectosController::class, 'indextableDocente'])->name('proyecto.indextableDocente');
Route::post('/proyectos/create/{integrantes}', [ProyectosController::class, 'create'])->name('proyecto.create');
Route::get('/usuario/consulta', [ProyectosController::class, 'buscarIntegrante'])->name('buscarIntegrante');

//comites
Route::get('/comite/integrantes/create/{idComite}', [ComitesController::class, 'createIntegrante'])->name('comite.integrantes.create');
Route::post('/comite/integrantes/store', [ComitesController::class, 'storeIntegrante'])->name('comite.integrantes.store');
Route::get('/comites/index', [ComitesController::class, 'index'])->name('comite.index');
Route::get('/comites/create', [ComitesController::class, 'create'])->name('comite.create');
Route::post('/comites/edit', [ComitesController::class, 'edit'])->name('comite.edit');
Route::post('/comites/update/{idComite}', [ComitesController::class, 'update'])->name('comite.update');
Route::post('/comites/destroy/{idComite}', [ComitesController::class, 'destroy'])->name('comite.destroy');
Route::get('/comites/restore/one/{idComite}', [ComitesController::class, 'restore'])->name('comite.restore');

//programas
Route::get('/programas/index', [SedeProgramaController::class, 'index'])->name('programas.index');
Route::get('/programas/rest', [SedeProgramaController::class, 'rest'])->name('programas.rest');
Route::post('/programas/store/{id}', [SedeProgramaController::class, 'store'])->name('programas.store');
Route::post('/programas/edit/{idPrograma}/{idSede}', [SedeProgramaController::class, 'edit'])->name('programa.edit');
Route::post('/programas/update/{idPrograma}/{idSede}', [SedeProgramaController::class, 'update'])->name('programa.update');
Route::post('/programas/destroy/{idPrograma}/{idSede}', [SedeProgramaController::class, 'destroy'])->name('programa.destroy');
Route::get('/programas/restore/one/{idPrograma}', [SedeProgramaController::class, 'restore'])->name('programa.restore');
Route::delete('/programas/force-delete/{idPrograma}', [SedeProgramaController::class, 'forceDelete'])->name('programa.forceDelete');

//cronograma
Route::get('/cronograma/index', [CronogramaController::class, 'index'])->name('cronograma.index')->middleware('can:cronograma.ver');
Route::get('/grupos/create', [CronogramaController::class, 'create'])->name('grupo.create')->middleware('can:cronograma.crear');
Route::get('/grupos/edit/{id}', [CronogramaController::class, 'edit'])->name('grupo.edit')->middleware('can:cronograma.editar');
Route::post('/grupos/update/{id}', [CronogramaController::class, 'update'])->name('grupo.update')->middleware('can:cronograma.editar');



//propuesta
Route::get('/propuestas/index', [FasePropuestasController::class, 'index'])->name('propuesta.index')->middleware('can:fases.acceso');
Route::get('/propuestas/create/{idProyecto}', [FasePropuestasController::class, 'create'])->name('propuesta.create')->middleware('can:fases.acceso');
Route::post('/propuestas/store', [FasePropuestasController::class, 'store'])->name('propuesta.store')->middleware('can:fases.acceso');
Route::get('/propuestas/edit', [FasePropuestasController::class, 'edit'])->name('propuesta.edit')->middleware('can:fases.acceso');
Route::post('/propuestas/createAnterior', [FasePropuestasController::class, 'createAnterior'])->name('propuesta.createAnterior')->middleware('can:fases.acceso');
Route::post('/propuestas/asignarDocente', [FasePropuestasController::class, 'asignarDocente'])->name('propuesta.asigDocente')->middleware('can:fases.acceso');



//anteproyecto
Route::get('/anteproyecto/create/{idProyecto}', [FaseAnteproyectosController::class, 'create'])->name('anteproyecto.create')->middleware('can:fases.acceso');
Route::post('/anteproyecto/store', [FaseAnteproyectosController::class, 'store'])->name('anteproyecto.store')->middleware('can:fases.acceso');
Route::post('/anteproyecto/createAnterior', [FaseAnteproyectosController::class, 'createAnterior'])->name('anteproyecto.createAnterior')->middleware('can:fases.acceso');
Route::get('/anteproyecto/verpdf/{nombreArchivo}/{ruta}', [FaseAnteproyectosController::class, 'verPdf'])->name('anteproyecto.verpdf')->middleware('can:fases.acceso');
Route::post('/anteproyecto/aprobarDocumento', [FaseAnteproyectosController::class, 'aprobarDoc'])->name('anteproyecto.aprobDoc')->middleware('can:fases.acceso');
Route::post('/anteproyecto/asignarJurado', [FaseAnteproyectosController::class, 'asigJurado'])->name('anteproyecto.asigJurado')->middleware('can:fases.acceso');
Route::put('/anteproyecto/update', [FaseAnteproyectosController::class, 'update'])->name('anteproyecto.update')->middleware('can:fases.acceso');



//ponderados
Route::get('/ponderados/index', [PonderadosController::class, 'index'])->name('ponderados.index');



//observaciones
Route::post('/observaciones/store/{fase}', [ObservacionesPropuestaController::class, 'store'])->name('observaciones.store');
Route::post('/observaciones/update', [ObservacionesPropuestaController::class, 'update'])->name('observaciones.update');



//mail routes
route::get('/aceptarInvitacion/{usuario}/{proyecto}', [ProyectosController::class, 'segundoIntegrante'])->name('segundoIntegrante');



//Proyecto final
Route::get('/proyectoFinal/create/{idProyecto}', [FaseProyectoFinalController::class, 'create'])->name('proyectoFinal.create')->middleware('can:fases.acceso');
Route::post('/proyectoFinal/store', [FaseProyectoFinalController::class, 'store'])->name('proyectoFinal.store')->middleware('can:fases.acceso');
Route::post('/proyectoFinal/createAnterior', [FaseProyectoFinalController::class, 'createAnterior'])->name('proyectoFinal.createAnterior')->middleware('can:fases.acceso');
Route::get('/proyectoFinal/verpdf/{nombreArchivo}/{ruta}', [FaseProyectoFinalController::class, 'verPdf'])->name('proyectoFinal.verpdf')->middleware('can:fases.acceso');
Route::post('/proyectoFinal/aprobarDocumento', [FaseProyectoFinalController::class, 'aprobarDoc'])->name('proyectoFinal.aprobDoc')->middleware('can:fases.acceso');
Route::post('/proyectoFinal/asignarJurado', [FaseProyectoFinalController::class, 'asigJurado'])->name('proyectoFinal.asigJurado')->middleware('can:fases.acceso');
Route::post('/proyectoFinal/update', [FaseProyectoFinalController::class, 'update'])->name('proyectoFinal.update')->middleware('can:fases.acceso');

//sustentacion
Route::get('/sustentacion/consultar', [ProyectosController::class, 'obtSustentacion'])->name('sustentacion.consultar')->middleware('can:fases.acceso');
Route::post('/sustentacion/storeaprobado', [ProyectosController::class, 'guardarSustaprobado'])->name('sustentacion.store.aprobado')->middleware('can:fases.acceso');
Route::post('/sustentacion/storerechazado', [ProyectosController::class, 'guardarSustrechazado'])->name('sustentacion.store.rechazado')->middleware('can:fases.acceso');
Route::get('/sustentacion/verpdf/{nombreArchivo}', [ProyectosController::class, 'mostrarPdf'])->name('sustentacion.verpdf')->middleware('can:fases.acceso');


Route::get('/biblioteca', [bibliotecaController::class, 'index'])->name('biblioteca.index')->middleware('can:biblioteca');

