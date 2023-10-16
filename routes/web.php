<?php

use App\Http\Controllers\SedesController;
use App\Http\Controllers\UsuariosController;

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
<<<<<<< HEAD
Route::get('/UsuariosUser/index', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('/UsuariosUser/edit/{numeroDocumento}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/UsuariosUser/update/{numeroDocumento}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::post('/UsuariosUser/cambioEstado/{numeroDocumento}',[UsuariosController::class,'cambioEstado'])->name('usuarios.cambioEstado');
Route::post('/UsuariosUser/destroy/{numeroDocumento}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');
Route::get('/UsuariosUser/restore/one/{numeroDocumento}', [UsuariosController::class, 'restore'])->name('usuarios.restore');
=======

Route::get('/usuarios/index', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('/usuarios/edit/{numeroDocumento}', [UsuariosController::class, 'edit'])->name('usuarios.edit');
Route::post('/usuarios/update/{numeroDocumento}', [UsuariosController::class, 'update'])->name('usuarios.update');
Route::post('/Usuarios/cambioEstado/{numeroDocumento}',[UsuariosController::class,'cambioEstado'])->name('usuarios.cambioEstado');

//sedes
Route::get('/sedes/index', [SedesController::class, 'index'])->name('sedes.index');
Route::post('/sedes/edit/{id}', [SedesController::class, 'edit'])->name('sedes.edit');

//facultades
Route::post('/facultades/index', [SedesController::class, 'index'])->name('facultades.index');
>>>>>>> 532e93e6d11725d2034e9084fe92f9eb841ebeb6
