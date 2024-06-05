<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\FaseCalOb;
use Illuminate\Http\Request;
use App\Models\Calificacione;
use App\Models\CalifSubitem;
use App\Models\FaseAnteproyecto;
use App\Models\FasePropuesta;
use App\Models\FaseProyectosfinale;
use App\Models\FaseSustentacione;
use App\Models\FaseSustentaciones;
use App\Models\PonderadosPropuesta;
use App\Models\PonderadoAnteproyecto;
use App\Models\PonderadoProyectof;
use App\Traits\funcionesUniversales;

class ObservacionesPropuestaController extends Controller
{
    use funcionesUniversales;
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

        $numeroJurado = '-1';
        //dd($fase);
        switch ($fase) {
            case 'propuesta':
                $tamaño = 5; //asigan la cantidad de observaciones y calificaciones
                Calificacione::insert($this->cargarCalificacionesPropuesta($request));

                $numeroJurado = '-1';
                break;

            case 'anteproyecto':
                $tamaño = 8; //asigan la cantidad de observaciones y calificaciones
                $this->cargarCalificacionesAnteproyecto($request);
                $numeroJurado = $request->numeroJurado;
                break;

            case 'proyFinal':
                $tamaño = 8; //asigan la cantidad de observaciones y calificaciones
                $this->cargarCalificacionesProFinal($request);
                $numeroJurado = $request->numeroJurado;
                $fase = 'proyecto_final';
                break;

            default:
                # code...
                break;
        }

        $idCalificaciones = Calificacione::orderBy('idCalificacion', 'desc')->take($tamaño)->pluck('idCalificacion');

        foreach($idCalificaciones as $calificacion) {
            //dd($fase);
            FaseCalOb::create([
                $fase => $request->idFase,
                'calificacion_fase' => $calificacion,
                'numeroJurado' => $numeroJurado,
            ]);
        }
        //dd($request->idFase);
        $this->cambioEstado($request->idFase, $fase, $numeroJurado);
        //dd($fase);
        switch ($fase) {
            case 'propuesta':
                return redirect()->route('proyecto.indextableComite');
                break;

            case 'anteproyecto':
                return redirect()->route('proyecto.indextableJurado');
                break;

            case 'proyecto_final':
                return redirect()->route('proyecto.indextableJurado');
                break;

            default:
                # code...
                break;
        }
    }



    public function cargarCalificacionesPropuesta($request)
    {
        //Conjunto de calificaciones a insertar en la base de datos
        $dataCalificaciones = [
            [
                'observacion' => $request->tituloObservacion,
                'calificacion' => $this->calcCalifPropuesta('Título', $request->tituloCalificacion, 'propuesta'),
                'cal_item' => $this->buscarIdItem('Título'),
            ],
            //
            [
                'observacion' => $request->lineaObservacion,
                'calificacion' => $this->calcCalifPropuesta('Linea de investigación', $request->lineaCalificacion, 'propuesta'),
                'cal_item' => $this->buscarIdItem('Linea de investigación'),
            ],
            //
            [
                'observacion' => $request->descProbObservacion,
                'calificacion' => $this->calcCalifPropuesta('Descripción del problema', $request->descProbCalificacion, 'propuesta'),
                'cal_item' => $this->buscarIdItem('Descripción del problema'),
            ],
            //
            [
                'observacion' => $request->objGenObservacion,
                'calificacion' => $this->calcCalifPropuesta('Objetivo general', $request->objGenCalificacion, 'propuesta'),
                'cal_item' => $this->buscarIdItem('Objetivo general'),
            ],
            //
            [
                'observacion' => $request->objEspObservacion,
                'calificacion' => $this->calcCalifPropuesta('Objetivos especificos', $request->objEspCalificacion, 'propuesta'),
                'cal_item' => $this->buscarIdItem('Objetivos especificos'),
            ]
        ];
        return $dataCalificaciones;
    }



    //captura las calificaciones y observaciones y devuelve un array
    public function cargarCalificacionesAnteproyecto($request)
    {
        $incrementador = 0;
        $itemsSubItems = $this->buscarNombresItems('anteproyecto');

        //dd($request);

        foreach ($itemsSubItems as $clave => $valor) {
            $dataCalificaciones = [];
            $numSubItems = 'canti'.$incrementador;
            $nameObs = 'obs'.$incrementador; //nombre de los campos de observaciones


            $datos = $this->calcCalifAnteproy($clave, 'anteproyecto', $request, $valor,$numSubItems, $nameObs);

            //dd($datos);
            CalifSubitem::insert($datos);
            //dd('d');
            $incrementador++;
        }
        //dd($dataCalificaciones);
        return $dataCalificaciones;
    }

    //captura las calificaciones y observaciones y devuelve un array
    public function cargarCalificacionesProFinal($request)
    {
        $incrementador = 0;
        $itemsSubItems = $this->buscarNombresItems('proyFinal');

        //dd($request);

        foreach ($itemsSubItems as $clave => $valor) {
            $dataCalificaciones = [];
            $numSubItems = 'canti'.$incrementador;
            $nameObs = 'obs'.$incrementador; //nombre de los campos de observaciones


            $datos = $this->calcCalifAnteproy($clave, 'proyFinal', $request, $valor,$numSubItems, $nameObs);

            //dd($datos[0]);
            CalifSubitem::insert($datos);
            //dd('d');
            $incrementador++;
        }
        //dd($dataCalificaciones);
        return $dataCalificaciones;
    }



    public function buscarIdItem($item)
    { //busca el item en la base de datos y extrae su id
        $idItem = Item::where('item', $item)->first()->idItem;
        return $idItem;
    }



    public function calcCalifPropuesta($item, $select, $fase)
    { //calcula la nota tipo double en base al item y a la opcion del select

        //dd($names);
        $idItem = $this->buscarIdItem($item);
        $ponderado = $fase == 'propuesta' ? PonderadosPropuesta::where('item_pond', $idItem)->first() : ($fase == 'anteproyecto' ? PonderadoAnteproyecto::where('item_pond', $idItem)->first() : null);

                if ($select == "si") {
                    return $ponderado->ponderado;
                } else if ($select == "parcial") {
                    return round((($ponderado->ponderado) / 2.0), 2);
                } else if ($select == "no") {
                    return 0;
                }

    }



    public function calcCalifAnteproy($item, $fase, $request, $names, $numSubItems, $nameObs)
    { //calcula la nota tipo double en base al item y a la opcion del select
        $idCalificacion = Calificacione::orderBy('idCalificacion', 'desc')->take(1)->pluck('idCalificacion');$idCalificacion = Calificacione::orderBy('idCalificacion', 'desc')->take(1)->pluck('idCalificacion');
        //dd($idCalificacion);
        if(!isset($idCalificacion[0])){
            $idCalificacion = [];
            array_push($idCalificacion, 0);
        }


        $idItem = $this->buscarIdItem($item);
        //dd($fase);
        if($fase == 'anteproyecto'){
            $ponderado = PonderadoAnteproyecto::where('item_pond', $idItem)->first();
        }else if($fase == 'proyFinal'){

            $ponderado = PonderadoProyectof::where('item_pond', $idItem)->first();

        }



        $totalCalificacion = 0;
        $datos = [];
        //dd($names);
        foreach($names[0] as $name){
            $jurado = $request->numeroJurado;
            //dd($names);
            $nombreSubItem = $name->codigo.$jurado;
            //dd($request->$nombreSubItem);
            if ($request->$nombreSubItem == "si") {
                $totalCalificacion += ($ponderado->ponderado / $request->$numSubItems);
                $valor = 1;
            } else if ($request->$nombreSubItem == "parcial") {
                $totalCalificacion += (($ponderado->ponderado / $request->$numSubItems) / 2.0);
                $valor = 3;
            } else if ($request->$nombreSubItem == "no") {
                $totalCalificacion += 0;
                $valor = 2;
            }
            //dd($valor);
            array_push($datos,[
                    'ValorCalifSubitem' => $valor,
                    'calificacion' => $idCalificacion[0]+1,
                    'subitem' => $name->idSubitem,
            ]);
            //dd($datos);
        }
        

        Calificacione::insert([
            'observacion' => $request->$nameObs,
            'calificacion' => $totalCalificacion,
            'cal_item' => $this->buscarIdItem($item),

        ]);
        //dd($datos);
        return $datos ;

    }

    public function cambioEstado($idfase, $fase, $numeroJurado)
    {
        $total = 0;

        $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
            ->where($fase, $idfase)
            ->get();

        foreach ($calificacionesAnterior as $calificacion) {
            $total += $calificacion->calificacion;
        }

        $propuesta = $fase == 'propuesta' ? FasePropuesta::findOrFail($idfase) : ($fase == 'anteproyecto' ? FaseAnteproyecto::findOrFail($idfase) : ($fase == 'proyecto_final' ? FaseProyectosfinale::findOrFail($idfase) :
            FaseSustentaciones::findOrFail($idfase)));


        switch ($fase) {
            case 'propuesta':
                if ($total >= 3.5) {
                    $propuesta->estado = 'Aprobado';
                    $propuesta->save();
                } else if ($total >= 3 && $total < 3.4) {
                    $propuesta->estado = 'Aplazado con modificaciones';
                    $propuesta->save();
                } else {
                    $propuesta->estado = 'Rechazado';
                    $propuesta->save();
                }
                break;


                case 'anteproyecto':
                    if ($total >= 3.5) {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Aprobado' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Aprobado' : null);
                        $propuesta->save();
                    } else if ($total >= 3 && $total < 3.5) {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Aplazado con modificaciones' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Aplazado con modificaciones' : null);
                        $propuesta->save();
                    } else {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Rechazado' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Rechazado' : null);
                        $propuesta->save();
                    }


                    $anteproy = FaseAnteproyecto::findOrFail($idfase);
                    if($anteproy->estadoJUno == 'Pendiente' || $anteproy->estadoJDos == 'Pendiente'){
                        $anteproy->estado = 'Activo';
                        $anteproy->save();
                    }else if($anteproy->estadoJUno == 'Aprobado' && $anteproy->estadoJDos == 'Aprobado'){
                        $anteproy->estado = 'Aprobado';
                        $anteproy->save();
                    }else if(($anteproy->estadoJUno == 'Aprobado' && $anteproy->estadoJDos == 'Aplazado con modificaciones') || ($anteproy->estadoJUno == 'Aplazado con modificaciones' && $anteproy->estadoJDos == 'Aprobado') || ($anteproy->estadoJUno == 'Aplazado con modificaciones' && $anteproy->estadoJDos == 'Aplazado con modificaciones')){
                        $anteproy->estado = 'Aplazado con modificaciones';
                        $anteproy->save();
                    }else if($anteproy->estadoJUno == 'Rechazado' && $anteproy->estadoJDos == 'Rechazado'){
                        $anteproy->estado = 'Rechazado';
                        $anteproy->save();
                    }

                    break;

                case 'proyecto_final':
                    if ($total >= 3.5) {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Aprobado' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Aprobado' : null);
                        $propuesta->save();
                    } else if ($total >= 3 && $total < 3.5) {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Aplazado con modificaciones' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Aplazado con modificaciones' : null);
                        $propuesta->save();
                    } else {
                        $numeroJurado == '0' ? $propuesta->estadoJUno = 'Rechazado' : ($numeroJurado == '1' ? $propuesta->estadoJDos = 'Rechazado' : null);
                        $propuesta->save();
                    }


                    $anteproy = FaseProyectosfinale::findOrFail($idfase);
                    if($anteproy->estadoJUno == 'Pendiente' || $anteproy->estadoJDos == 'Pendiente'){
                        $anteproy->estado = 'Activo';
                        $anteproy->save();
                    }else if($anteproy->estadoJUno == 'Aprobado' && $anteproy->estadoJDos == 'Aprobado'){
                        $anteproy->estado = 'Aprobado';
                        $anteproy->save();
                    }else if(($anteproy->estadoJUno == 'Aprobado' && $anteproy->estadoJDos == 'Aplazado con modificaciones') || ($anteproy->estadoJUno == 'Aplazado con modificaciones' && $anteproy->estadoJDos == 'Aprobado') || ($anteproy->estadoJUno == 'Aplazado con modificaciones' && $anteproy->estadoJDos == 'Aplazado con modificaciones')){
                        $anteproy->estado = 'Aplazado con modificaciones';
                        $anteproy->save();
                    }else if($anteproy->estadoJUno == 'Rechazado' && $anteproy->estadoJDos == 'Rechazado'){
                        $anteproy->estado = 'Rechazado';
                        $anteproy->save();
                    }

                    break;

            default:
                # code...
                break;
        }

    }


    // public function ultimaObservacion($idPropuesta)
    // {
    //     $observacionesAnterior = ObservacionesCalificaciones::join('fase_cal_obs', 'fase_cal_obs.observacion_fase', 'observaciones_calificaciones.idObservacion')
    //         ->where('propuesta', $idPropuesta)
    //         ->orderBy('idObservacion', 'asc')
    //         ->get();
    //     return $observacionesAnterior;
    // }
    public function ultimaCalificacion($idPropuesta)
    {
        $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
            ->where('propuesta', $idPropuesta)
            ->orderBy('idCalificacion', 'asc')
            ->get();
        return $calificacionesAnterior;
    }
}
