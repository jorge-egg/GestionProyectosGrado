<?php

namespace App\Http\Controllers;

use App\Models\FechasGrupo;
use Illuminate\Http\Request;
use App\Models\CronogramaGrupo;
use App\Models\Sede;
use App\Models\SedeProyectosGrado;
use App\Models\UsuariosUser;
use Illuminate\Support\Facades\Auth;

class CronogramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId  = auth()->id();
        $usuario = UsuariosUser::where('usua_users', $userId)->whereNull('deleted_at')->first();
        $sede    = Sede::findOrFail($usuario->usua_sede);

        $cronograma = SedeProyectosGrado::join('proyecto_fases', 'proyecto_fases.fase_proy', 'sede_proyectos_grado.idProyecto')
        ->join('sedes', 'sedes.idSede', 'sede_proyectos_grado.proy_sede')->where('idSede', $sede->idSede)->get();
        dd($cronograma, $sede->idSede);

        //obtener el id de los ultimos 4 grupos creados
        $ultimosId = CronogramaGrupo::latest('idGrupo')->take(4)->get('idGrupo');
        //se obtiene la informacion de cada grupo individualmente
        $grupo1 = FechasGrupo::all()->where('fech_grup', $ultimosId[0]->idGrupo);
        $grupo2 = FechasGrupo::all()->where('fech_grup', $ultimosId[1]->idGrupo);
        $grupo3 = FechasGrupo::all()->where('fech_grup', $ultimosId[2]->idGrupo);
        $grupo4 = FechasGrupo::all()->where('fech_grup', $ultimosId[3]->idGrupo);

        return view('Layouts.cronograma.read', compact('grupo1', 'grupo2', 'grupo3', 'grupo4'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
