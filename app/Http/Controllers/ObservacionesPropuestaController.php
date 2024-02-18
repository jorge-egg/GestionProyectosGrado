<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\FaseCalOb;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Calificacione;
use App\Models\FaseAnteproyecto;
use App\Models\FasePropuesta;
use App\Models\FaseProyectosfinale;
use App\Models\FaseSustentacione;
use App\Models\PonderadosPropuesta;
use App\Models\ObservacionesCalificacione;
use App\Models\PonderadoAnteproyecto;

class ObservacionesPropuestaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $fase)
    {
        switch ($fase) {
            case 'propuesta':
                ObservacionesCalificacione::insert($this->cargarObservacionesPropuesta($request));
                Calificacione::insert($this->cargarCalificacionesPropuesta($request));
                break;

            case 'anteproyecto':
                ObservacionesCalificacione::insert($this->cargarObservacionesAnteproyecto($request));
                Calificacione::insert($this->cargarCalificacionesAnteproyecto($request));
                break;

            default:
                # code...
                break;
        }

        $idCalificaciones = Calificacione::orderBy('idCalificacion', 'desc')->take(5)->pluck('idCalificacion');
        $idObservaciones = ObservacionesCalificacione::orderBy('idObservacion', 'desc')->take(5)->pluck('idObservacion');
        $combineData = $idCalificaciones->combine($idObservaciones);
        $combineData->each(function ($observacionId, $calificacionId) use ($request, $fase) {
            $faseModificada = Str::singular($fase);
            FaseCalOb::create([
                $faseModificada => $request->idFase,
                'calificacion_fase' => $calificacionId,
                'observacion_fase' => $observacionId,
            ]);
        });

        $this->cambioEstado($request->idFase, $fase);
        return redirect()->route('proyecto.indextableComite');
    }

    public function cargarObservacionesPropuesta($request){
        //conjunto de Observaciones a insertar en la base de datos
        $dataObservaciones = [[
            'observacion' => $request->tituloObservacion,
            'obs_item' => $this->buscarIdItem('Titulo'),
            ],
            //
            [
            'observacion' => $request->lineaObservacion,
            'obs_item' => $this->buscarIdItem('Linea de investigación'),
            ],
            //
            [
            'observacion' => $request->descProbObservacion,
            'obs_item' => $this->buscarIdItem('Descripción del problema'),
            ],
            //
            [
            'observacion' => $request->objGenObservacion,
            'obs_item' => $this->buscarIdItem('Objetivo general'),
            ],
            //
            [
            'observacion' => $request->objEspObservacion,
            'obs_item' => $this->buscarIdItem('Objetivos especificos'),
        ]];
        return $dataObservaciones;
    }
    public function cargarObservacionesAnteproyecto($request){
        //conjunto de Observaciones a insertar en la base de datos
        $dataObservaciones = [[
            'observacion' => $request->tituloObservacion,
            'obs_item' => $this->buscarIdItem('Título'),
            ],
            //
            [
            'observacion' => $request->introObservacion,
            'obs_item' => $this->buscarIdItem('Introduccion'),
            ],
            //
            [
            'observacion' => $request->planProbObservacion,
            'obs_item' => $this->buscarIdItem('Planteamiento del problema'),
            ],
            //
            [
            'observacion' => $request->justObservacion,
            'obs_item' => $this->buscarIdItem('Justificación'),
            ],
            //
            [
            'observacion' => $request->marcRefObservacion,
            'obs_item' => $this->buscarIdItem('Marco referencial'),
            ],
            //
            [
                'observacion' => $request->metodObservacion,
                'obs_item' => $this->buscarIdItem('Metodología'),
            ],
            //
            [
                'observacion' => $request->admCtrObservacion,
                'obs_item' => $this->buscarIdItem('Elementos de administración y control'),
            ],
            //
            [
                'observacion' => $request->normBibliObservacion,
                'obs_item' => $this->buscarIdItem('Normas de presentación en el documento y referencias bibliográficas'),
            ],
        ];
        return $dataObservaciones;
    }

    public function cargarCalificacionesPropuesta($request){
        //Conjunto de calificaciones a insertar en la base de datos
        $dataCalificaciones = [[
            'calificacion' => $this->calcularCalificacion('Titulo', $request->tituloCalificacion, 'propuesta'),
            'cal_item' => $this->buscarIdItem('Titulo'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Linea de investigación', $request->lineaCalificacion, 'propuesta'),
            'cal_item' => $this->buscarIdItem('Linea de investigación'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Descripción del problema', $request->descProbCalificacion, 'propuesta'),
            'cal_item' => $this->buscarIdItem('Descripción del problema'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Objetivo general', $request->objGenCalificacion, 'propuesta'),
            'cal_item' => $this->buscarIdItem('Objetivo general'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Objetivos especificos', $request->objEspCalificacion, 'propuesta'),
            'cal_item' => $this->buscarIdItem('Objetivos especificos'),
        ]];
        return $dataCalificaciones;
    }

    public function cargarCalificacionesAnteproyecto($request){
        //Conjunto de calificaciones a insertar en la base de datos
        $dataCalificaciones = [[
            'calificacion' => $this->calcularCalificacion('Título', $request->tituloCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Título'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Introduccion', $request->introCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Introduccion'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Planteamiento del problema', $request->planProbCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Planteamiento del problema'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Justificación', $request->justCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Justificación'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Marco referencial', $request->marcRefCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Marco referencial'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Metodología', $request->metodCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Metodología'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Elementos de administración y control', $request->admCtrCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Elementos de administración y control'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Normas de presentación en el documento y referencias bibliográficas', $request->normBibliCalificacion, 'anteproyecto'),
            'cal_item' => $this->buscarIdItem('Normas de presentación en el documento y referencias bibliográficas'),
            ]
        ];
        return $dataCalificaciones;
    }

    public function buscarIdItem($item){//busca el item en la base de datos y extrae su id
        $idItem = Item::where('item', $item)->first()->idItem;
        return $idItem;
    }

    public function calcularCalificacion($item, $select, $fase){ //calcula la nota tipo double en base al item y a la opcion del select
        $idItem = $this->buscarIdItem($item);
        $ponderado = $fase == 'propuesta' ? PonderadosPropuesta::where('item_pond', $idItem)->first() :
        ($fase == 'anteproyecto'? PonderadoAnteproyecto::where('item_pond', $idItem)->first() : null );
        if($select == "si")
        {
            return $ponderado->ponderado;
        }else if($select == "parcial")
        {
            return round((($ponderado->ponderado)/2.0), 2);
        }else if($select == "no")
        {
            return 0;
        }
    }

    public function cambioEstado($idfase, $fase){
        $total = 0;
        $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where($fase, $idfase)
                ->get();
        foreach ($calificacionesAnterior as $calificacion) {
            $total+=$calificacion->calificacion;
        }
        $propuesta = $fase == 'propuesta' ? FasePropuesta::findOrFail($idfase) :
            ($fase == 'anteproyecto' ? FaseAnteproyecto::findOrFail($idfase) :
            ($fase == 'proyectoFinal' ? FaseProyectosfinale::findOrFail($idfase):
            FaseSustentacione::findOrFail($idfase)));
        if($total >= 3.5){
            $propuesta -> estado = 'Aprobado';
            $propuesta -> save();
        }else if($total >= 3 && $total < 3.4){
            $propuesta -> estado = 'Aplazado con modificaciones';
            $propuesta -> save();
        }else{
            $propuesta -> estado = 'Rechazado';
            $propuesta -> save();
        }
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
        $incrementoObs = 0;
            foreach ($this->ultimaObservacion($request->idPropuesta) as $observacion) {
                $observacion->observacion = $this->cargarObservaciones($request)[$incrementoObs]['observacion'];
                $observacion->save();
                $incrementoObs++;
            }
            $incrementoCal = 0;
            foreach ($this->ultimaCalificacion($request->idPropuesta) as $calificacion) {

                $calificacion->calificacion = $this->cargarCalificaciones($request)[$incrementoCal]['calificacion'];

                $calificacion->save();
                $incrementoCal++;
            }
            $this->cambioEstado($request->idPropuesta);
            return redirect()->route('proyecto.indextable');
    }

    public function ultimaObservacion($idPropuesta)
    {
            $observacionesAnterior = ObservacionesCalificacione::join('fase_cal_obs', 'fase_cal_obs.observacion_fase', 'observaciones_calificaciones.idObservacion')
                ->where('propuesta', $idPropuesta)
                ->orderBy('idObservacion', 'asc')
                ->get();
        return $observacionesAnterior;
    }
    public function ultimaCalificacion($idPropuesta)
    {
            $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
            ->where('propuesta', $idPropuesta)
            ->orderBy('idCalificacion', 'asc')
            ->get();
        return $calificacionesAnterior;
    }
}
