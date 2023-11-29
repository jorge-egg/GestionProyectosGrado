<?php

namespace App\Http\Controllers;

use App\Models\Calificacione;
use App\Models\FaseCalOb;
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

        ObservacionesCalificacione::insert($dataObservaciones);
        Calificacione::insert($dataCalificaciones);

        $idCalificaciones = Calificacione::orderBy('idCalificacion', 'desc')->take(5)->pluck('idCalificacion');
        $idObservaciones = ObservacionesCalificacione::orderBy('idObservacion', 'desc')->take(5)->pluck('idObservacion');
        $combineData = $idCalificaciones->combine($idObservaciones);
        $combineData->each(function ($observacionId, $calificacionId) use ($request) {

            FaseCalOb::create([
                'propuesta' => $request->idPropuesta,
                'calificacion' => $calificacionId,
                'observacion' => $observacionId,
            ]);
        });

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
