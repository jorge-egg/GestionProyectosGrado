<?php

namespace App\Http\Controllers;

use App\Models\Calificacione;
use App\Models\FaseCalOb;
use App\Models\FasePropuesta;
use App\Models\Item;
use App\Models\ObservacionesCalificacione;
use App\Models\PonderadosPropuesta;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        ObservacionesCalificacione::insert($this->cargarObservaciones($request));
        Calificacione::insert($this->cargarCalificaciones($request));

        $idCalificaciones = Calificacione::orderBy('idCalificacion', 'desc')->take(5)->pluck('idCalificacion');
        $idObservaciones = ObservacionesCalificacione::orderBy('idObservacion', 'desc')->take(5)->pluck('idObservacion');
        $combineData = $idCalificaciones->combine($idObservaciones);
        $combineData->each(function ($observacionId, $calificacionId) use ($request) {

            FaseCalOb::create([
                'propuesta' => $request->idPropuesta,
                'calificacion_fase' => $calificacionId,
                'observacion_fase' => $observacionId,
            ]);
        });

        $this->cambioEstado($request->idPropuesta);
        return redirect()->route('proyecto.indextableComite');
    }

    public function cargarObservaciones($request){
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

    public function cargarCalificaciones($request){
        //Conjunto de calificaciones a insertar en la base de datos
        $dataCalificaciones = [[
            'calificacion' => $this->calcularCalificacion('Titulo', $request->tituloCalificacion),
            'cal_item' => $this->buscarIdItem('Titulo'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Linea de investigación', $request->lineaCalificacion),
            'cal_item' => $this->buscarIdItem('Linea de investigación'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Descripción del problema', $request->descProbCalificacion),
            'cal_item' => $this->buscarIdItem('Descripción del problema'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Objetivo general', $request->objGenCalificacion),
            'cal_item' => $this->buscarIdItem('Objetivo general'),
            ],
            //
            [
            'calificacion' => $this->calcularCalificacion('Objetivos especificos', $request->objEspCalificacion),
            'cal_item' => $this->buscarIdItem('Objetivos especificos'),
        ]];
        return $dataCalificaciones;
    }

    public function buscarIdItem($item){//busca el item en la base de datos y extrae su id
        $idItem = Item::where('item', $item)->first()->idItem;
        return $idItem;
    }

    public function calcularCalificacion($item, $select){ //calcula la nota tipo double en base al item y a la opcion del select
        $idItem = $this->buscarIdItem($item);
        $ponderado = PonderadosPropuesta::where('item_pond', $idItem)->first();
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

    public function cambioEstado($idPropuesta){
        $total = 0;
        $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
                ->where('propuesta', $idPropuesta)
                ->get();
        foreach ($calificacionesAnterior as $calificacion) {
            $total+=$calificacion->calificacion;
        }
        if($total >= 3.5){
            $propuesta = FasePropuesta::findOrFail($idPropuesta);
            $propuesta -> estado = 'Aprobado';
            $propuesta -> save();
        }else if($total >= 3 && $total < 3.4){
            $propuesta = FasePropuesta::findOrFail($idPropuesta);
            $propuesta -> estado = 'Aplazado con modificaciones';
            $propuesta -> save();
        }else{
            $propuesta = FasePropuesta::findOrFail($idPropuesta);
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
