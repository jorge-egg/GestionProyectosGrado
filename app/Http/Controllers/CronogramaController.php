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
        $userId  = auth()->id();
        $usuario = UsuariosUser::where('usua_users', $userId)->whereNull('deleted_at')->first();
        $sede    = Sede::findOrFail($usuario->usua_sede);

        $idCronograma = Sede::join('sede_proyectos_grado as proyecto_grado', 'proyecto_grado.proy_sede', 'sedes.idSede')
        ->join('proyecto_fases', 'proyecto_fases.fase_proy', 'proyecto_grado.idProyecto')
        ->join('proyecto_cronogramas', 'proyecto_cronogramas.idCronograma', 'proyecto_fases.fase_cron')
        ->where('sedes.idSede', $sede->idSede)
        ->orderBy('proyecto_cronogramas.idCronograma', 'desc')
        ->select('proyecto_cronogramas.idCronograma')
        ->first();

        return view('Layouts.cronograma.createGroup', compact('idCronograma'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $grupo = CronogramaGrupo::create([
            'estado' => "pendiente",
            'cron_fech' => $request->idCronograma,
        ]);
        for($incremento = 1; $incremento >= 4; $incremento++){

            $fecha_apertura = "fecha_apertura_".$incremento;
            $fecha_cierre = "fecha_cierre_".$incremento;
            $fecha->fecha_apertura = $request->$fecha_apertura;
            $fecha->fecha_cierre   = $request->$fecha_cierre;
            $incremento++;
            $fecha->save();
        }

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
    public function edit(Request $request, $id)
    {
        $grupoFechas = FechasGrupo::where('fech_grup', $id)->get();
        return view('Layouts.cronograma.editGroup', compact('grupoFechas'));
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
        $grupoFechas = FechasGrupo::where('fech_grup', $id)->get();
        $incremento = 1;
        foreach ($grupoFechas as $fecha) {
            $fecha_apertura = "fecha_apertura_".$incremento;
            $fecha_cierre = "fecha_cierre_".$incremento;
            $fecha->fecha_apertura = $request->$fecha_apertura;
            $fecha->fecha_cierre   = $request->$fecha_cierre;
            $incremento++;
            $fecha->save();
        }
        return redirect()->route('cronograma.index');
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
