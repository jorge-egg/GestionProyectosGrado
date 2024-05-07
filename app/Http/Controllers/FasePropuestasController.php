<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Calificacione;
use App\Models\FasePropuesta;
use App\Models\SedeProyectosGrado;
use App\Models\Integrante;
use App\Traits\funcionesUniversales;

class FasePropuestasController extends Controller
{
    use funcionesUniversales;
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
        $integrantes = Integrante::where('proyecto', $idProyecto)->with('usuarios_user')->get();
        $miembrosDocente = $this->obtenerDocentes($idProyecto);
        $propuestaAnterior = $this->ultimaPropuesta($idProyecto, 'desc');
        $calificacion = $this->ultimaCalificacion($propuestaAnterior->idPropuesta);
        //dd($calificacion);
        $estadoButton = true;
        $rangoFecha = $this->rangoFecha('propuesta');
        try {
            $totalCalificacion = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where('propuesta', $propuestaAnterior->idPropuesta)
                ->sum('calificaciones.calificacion'); // Suma de las calificaciones
                // ->get()->count();
        } catch (Exception $e) {
            $totalCalificacion = 0;
        }

        $validarCalificacion = ($totalCalificacion == 0) ? true : false;

        return view('Layouts.propuesta.create', compact('propuestaAnterior', 'calificacion', 'validarCalificacion', 'rangoFecha', 'estadoButton', 'miembrosDocente', 'integrantes', 'totalCalificacion'));
    }

    public function createAnterior(Request $request)
    {
        $idProyecto = $request->idProyecto;
        $propuestaAnterior = $this->ultimaPropuesta($idProyecto, 'asc');
        $calificacion = $this->ultimaCalificacion($propuestaAnterior->idPropuesta);

        $estadoButton = $propuestaAnterior->idPropuesta <= 1 ? true : false;
        $rangoFecha = $this->rangoFecha('propuesta');
        try {
            $totalCalificacion = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where('propuesta', $propuestaAnterior->idPropuesta)
                ->get()->count();
        } catch (Exception $e) {
            $totalCalificacion = 0;
        }

        $validarCalificacion = ($totalCalificacion == 0) ? true : false;

        return view('Layouts.propuesta.create', compact('idProyecto', 'propuestaAnterior', 'calificacion', 'validarCalificacion', 'rangoFecha', 'estadoButton'));
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

    //consultar si existen calificaciones creadas por el usuario y tomar las d la ultima propuesta
    public function ultimaCalificacion($idPropuesta)
    {
        try {
            $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where('propuesta', $idPropuesta)
                ->orderBy('idCalificacion', 'desc')
                ->take(5)
                ->get();

            $array = [];
            foreach ($calificacionesAnterior as $calificacion) {
                $dato = [
                    'calificacion' => $calificacion->calificacion,
                    'observacion' => $calificacion->observacion
                ];
                array_push($array, $dato);
            }

            if (count($calificacionesAnterior) == 0) {
                for ($i = 0; $i < 5; $i++) {
                    $dato = [
                        'calificacion' => "--",
                        'observacion' => ''
                    ];
                    array_push($array, $dato);
                }
            }
        } catch (Exception $e) {
            $array = [];
            for ($i = 0; $i < 5; $i++) {
                $dato = [
                    'calificacion' => "--",
                    'observacion' => ''
                ];
                array_push($array, $dato);
            }
        }
        return $array;
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
                'titulo' => $request->titulo,
                'linea_invs' => $request->linea_invs,
                'desc_problema' => $request->desc_problema,
                'estado' => 'pendiente',
                'prop_proy' => $request->idProyecto,
                'obj_general' => $request->obj_general,
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
        return $validacion;
    }

    public function asignarDocente(Request $request)
    {//guarda un docente en la base de datos par el proyecto
        $idProyecto = $request->idProyecto;
        $numeroDocumento = $request->numeroDocumento;
        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);
        $proyecto->docente = $numeroDocumento;
        $proyecto->save();

        return redirect()->route('propuesta.create', ['idProyecto' => $idProyecto]);
    }

}
