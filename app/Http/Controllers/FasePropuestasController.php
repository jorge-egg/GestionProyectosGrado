<?php

namespace App\Http\Controllers;

use Error;
use Exception;
use App\Models\Sede;
use App\Models\FaseCalOb;
use App\Models\FechasGrupo;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\Calificacione;
use App\Models\FasePropuesta;
use App\Models\ObservacionesCalificacione;

class FasePropuestasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        return view('Layouts.propuesta.index', compact('propuestas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $idProyecto = $request->idProyecto;
        $propuestaAnterior = $this->ultimaPropuesta($idProyecto, 'desc');
        $observaciones = $this->ultimaObservacion($propuestaAnterior->idPropuesta);
        $calificacion = $this->ultimaCalificacion($propuestaAnterior->idPropuesta);
        $this->ultimaFecha();
        try{
            $totalCalificacion = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
        ->where('propuesta', $propuestaAnterior->idPropuesta)
        ->get()->count();
        } catch(Exception $e){
            $totalCalificacion = 0;
        }

        $validarCalificacion = ($totalCalificacion == 0) ? true : false;

        return view('Layouts.propuesta.create', compact('idProyecto', 'propuestaAnterior', 'observaciones', 'calificacion', 'validarCalificacion'));
    }

    public function createAnterior(Request $request)
    {
        $idProyecto = $request->idProyecto;
        $propuestaAnterior = $this->ultimaPropuesta($idProyecto, 'asc');
        $observaciones = $this->ultimaObservacion($propuestaAnterior->idPropuesta);
        $calificacion = $this->ultimaCalificacion($propuestaAnterior->idPropuesta);

        try{
            $totalCalificacion = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
        ->where('propuesta', $propuestaAnterior->idPropuesta)
        ->get()->count();
        } catch(Exception $e){
            $totalCalificacion = 0;
        }

        $validarCalificacion = ($totalCalificacion == 0) ? true : false;

        return view('Layouts.propuesta.create', compact('idProyecto', 'propuestaAnterior', 'observaciones', 'calificacion', 'validarCalificacion'));
    }

    //consultar si existen propuestas creadas por el usuario y tomar la ultima
    public function ultimaPropuesta($idProyecto, $orden)
    {
        $propuestaAnterior = FasePropuesta::where('prop_proy', $idProyecto)->orderBy('idPropuesta', $orden)->first();
        if ($propuestaAnterior == null) {
            $propuestaAnterior = (object) array(
                'idPropuesta' => "",
                'titulo' => "",
                'linea_invs' => "",
                'desc_problema' => "",
                'obj_general' => "",
                'obj_especificos' => "",
                'estado' => "Activo"
            );
        }
        return $propuestaAnterior;
    }

    //consultar si existen observaciones creadas por el usuario y tomar la ultima
    public function ultimaObservacion($idPropuesta)
    {
        try {
            $observacionesAnterior = ObservacionesCalificacione::join('fase_cal_obs', 'fase_cal_obs.observacion_fase', 'observaciones_calificaciones.idObservacion')
                ->where('propuesta', $idPropuesta)
                ->orderBy('idObservacion', 'asc')
                ->get();
            $array = [];
            foreach ($observacionesAnterior as $observacion) {
                $dato = $observacion->observacion;
                array_push($array, $dato);
            }
            if ($observacionesAnterior->empty()) {
                for ($i = 0; $i < 5; $i++) {
                    array_push($array, "");
                }
            }
        } catch (Exception $e) {
            $array = [];
            for ($i = 0; $i < 5; $i++) {
                array_push($array, "");
            }
        }
        return $array;
    }

     //consultar si existen calificaciones creadas por el usuario y tomar las d la ultima propuesta
    public function ultimaCalificacion($idPropuesta)
    {
        try {
            $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where('propuesta', $idPropuesta)
                ->orderBy('idCalificacion', 'asc')
                ->get();
            $array = [];
            foreach ($calificacionesAnterior as $calificacion) {
                $dato = $calificacion->calificacion;
                array_push($array, $dato);
            }
            if ($calificacionesAnterior->empty()) {
                for ($i = 0; $i < 5; $i++) {
                    array_push($array, "--");
                }
            }
        } catch (Exception $e) {
            $array = [];
            for ($i = 0; $i < 5; $i++) {
                array_push($array, "--");
            }
        }
        return $array;
    }

    //consultar la ultima fecha de propuestas mas cercana a la actual
    public function ultimaFecha(){
        $userId  = auth()->id();
        $usuario = UsuariosUser::where('usua_users', $userId)->whereNull('deleted_at')->first();
        $sede    = Sede::findOrFail($usuario->usua_sede);

        $grupos = Sede::join('proyecto_cronogramas', 'proyecto_cronogramas.cron_sede', 'sedes.idSede')
        ->join('cronograma_grupos', 'cronograma_grupos.grup_cron', 'proyecto_cronogramas.idCronograma')
        ->where('sedes.idSede', $sede->idSede)
        ->orderBy('cronograma_grupos.idGrupo', 'asc')
        ->take(4)
        ->select('cronograma_grupos.*')
        ->where('estado', 'activo')
        ->get();
        $array = [];
        foreach($grupos as $grupo){
            $dato = FechasGrupo::where('fech_grup', $grupo->idGrupo)->where('fech_fase', 1)->select('idFecha', 'fecha_apertura', 'fecha_cierre')->get();
            array_push($array, $dato);

        } //dd($array);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->verificarCantProp($request->idProyecto)) {
            $propuesta = FasePropuesta::create([
                'titulo'          => $request->titulo,
                'linea_invs'      => $request->linea_invs,
                'desc_problema'   => $request->desc_problema,
                'estado'          => 'pendiente',
                'prop_proy'       => $request->idProyecto,
                'obj_general'     => $request->obj_general,
                'obj_especificos' => $request->obj_especificos
            ]);

            if (!$propuesta) {
                return redirect()->route('proyecto.indextable')->with('error', 'hubo un error al crear el registro');
            }
        } else {
            return redirect()->route('proyecto.indextable')->with('error', 'ya cumplio con el maximo de intentos disponibles');
        }
        return redirect()->route('proyecto.indextable')->with('success', 'Se ha agregado con exito');
    }

    public function verificarCantProp($idProyecto)
    {
        $cantidad = FasePropuesta::where('prop_proy', $idProyecto)->get()->count();
        $validacion = $cantidad < 2 ? true : false;
        return  $validacion;
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
    public function update(Request $request)
    {
        //
    }

}
