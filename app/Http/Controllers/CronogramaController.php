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

        $grupos = Sede::join('sede_proyectos_grado as proyecto_grado', 'proyecto_grado.proy_sede', 'sedes.idSede')
        ->join('proyecto_fases', 'proyecto_fases.fase_proy', 'proyecto_grado.idProyecto')
        ->join('proyecto_cronogramas', 'proyecto_cronogramas.idCronograma', 'proyecto_fases.fase_cron')
        ->join('cronograma_grupos', 'cronograma_grupos.cron_fech', 'proyecto_cronogramas.idCronograma')
        ->where('sedes.idSede', $sede->idSede)
        ->orderBy('cronograma_grupos.idGrupo', 'desc')
        ->take(4)
        ->select('cronograma_grupos.*')
        ->get();

        $array = [];
        foreach($grupos as $key => $value){
            $dato = FechasGrupo::all()->where('fech_grup', $value->idGrupo);
            $key = $key++;
            $nombre = $key;
            $array[$nombre] = $dato;

        }


        return view('Layouts.cronograma.read', compact('array'));
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
    public function edit(Request $request)
    {
        
        return view('Layouts.cronograma.editGroup');
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
