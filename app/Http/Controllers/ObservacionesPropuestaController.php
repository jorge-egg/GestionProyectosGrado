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

        $numeroJurado = '-1';
        switch ($fase) {
            case 'propuesta':
                $tamaño = 5; //asigan la cantidad de observaciones y calificaciones
                ObservacionesCalificacione::insert($this->cargarObservacionesPropuesta($request));
                Calificacione::insert($this->cargarCalificacionesPropuesta($request));
                $numeroJurado = '-1';
                break;

            case 'anteproyecto':
                $names = [
                    'observaciones' => [
                        'tituloObservacion',
                        'introObservacion',
                        'planProbObservacion',
                        'justObservacion',
                        'marcRefObservacion',
                        'metodObservacion',
                        'admCtrObservacion',
                        'normBibliObservacion',

                    ],
                    'calificacion' => [
                        'tituloCalificacion',
                        'introCalificacion',
                        'planProbCalificacion',
                        'justCalificacion',
                        'marcRefCalificacion',
                        'metodCalificacion',
                        'admCtrCalificacion',
                        'normBibliCalificacion',
                    ],
                ];
                //dd($request->tituloObservacion);
                $tamaño = 8; //asigan la cantidad de observaciones y calificaciones
                ObservacionesCalificacione::insert($this->cargarObservacionesAnteproyecto($request, $names['observaciones']));
                Calificacione::insert($this->cargarCalificacionesAnteproyecto($request, $names['calificacion']));
                $numeroJurado = $request->numeroJurado;
                break;

            default:
                # code...
                break;
        }

        $idCalificaciones = Calificacione::orderBy('idCalificacion', 'desc')->take($tamaño)->pluck('idCalificacion');
        $idObservaciones = ObservacionesCalificacione::orderBy('idObservacion', 'desc')->take($tamaño)->pluck('idObservacion');
        $combineData = $idCalificaciones->combine($idObservaciones);
        $combineData->each(function ($observacionId, $calificacionId) use ($request, $fase, $numeroJurado) {
            //dd($fase);
            FaseCalOb::create([
                $fase => $request->idFase,
                'calificacion_fase' => $calificacionId,
                'observacion_fase' => $observacionId,
                'numeroJurado' => $numeroJurado,
            ]);
        });

        $this->cambioEstado($request->idFase, $fase);

        switch ($fase) {
            case 'propuesta':
                return redirect()->route('proyecto.indextableComite');
                break;

            case 'anteproyecto':
                return redirect()->route('proyecto.indextableDocente');
                break;

            default:
                # code...
                break;
        }
    }

    public function cargarObservacionesPropuesta($request)
    {
        //conjunto de Observaciones a insertar en la base de datos
        $dataObservaciones = [
            [
                'observacion' => $request->tituloObservacion,
                'obs_item' => $this->buscarIdItem('Título'),
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
            ]
        ];
        return $dataObservaciones;
    }
    public function cargarObservacionesAnteproyecto($request, $names)
    {
        //conjunto de Observaciones a insertar en la base de datos

        foreach($names as $name){
            $dato1 = $request->$name;
            $dato2 = $this->buscarIdItem('Título');
            dd($dato1);
            // 'observacion' => ,
            // 'obs_item' =>
        }
        $dataObservaciones = [
            [
                'observacion' => $request->$names[0],
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

    public function cargarCalificacionesPropuesta($request)
    {
        //Conjunto de calificaciones a insertar en la base de datos
        $dataCalificaciones = [
            [
                'calificacion' => $this->calcularCalificacion('Título', $request->tituloCalificacion, 'propuesta', 0),
                'cal_item' => $this->buscarIdItem('Título'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Linea de investigación', $request->lineaCalificacion, 'propuesta', 0),
                'cal_item' => $this->buscarIdItem('Linea de investigación'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Descripción del problema', $request->descProbCalificacion, 'propuesta', 0),
                'cal_item' => $this->buscarIdItem('Descripción del problema'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Objetivo general', $request->objGenCalificacion, 'propuesta', 0),
                'cal_item' => $this->buscarIdItem('Objetivo general'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Objetivos especificos', $request->objEspCalificacion, 'propuesta', 0),
                'cal_item' => $this->buscarIdItem('Objetivos especificos'),
            ]
        ];
        return $dataCalificaciones;
    }

    public function cargarCalificacionesAnteproyecto($request, $names)
    {
        //Conjunto de calificaciones a insertar en la base de datos
        $clave = [
            'Titulo',
            'Introducción',
            'Planteamiento del problema',
            'Justificación',
            'Marco referencial',
            'Metodologia',
            'Elementos de administración y control',
            'Normas de presentación en el documento y Referencias bibliográficas',
        ];

        //dd('canti'.str_replace(" ", "", $clave[0]));
        $dataCalificaciones = [
            [
                'calificacion' => $this->calcularCalificacion('Título', $request->tituloCalificacion, 'anteproyecto', $request->cantiTitulo, $request,0, $names),
                'cal_item' => $this->buscarIdItem('Título'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Introduccion', $request->introCalificacion, 'anteproyecto', $request->cant.str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Introduccion'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Planteamiento del problema', $request->planProbCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Planteamiento del problema'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Justificación', $request->justCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Justificación'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Marco referencial', $request->marcRefCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Marco referencial'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Metodología', $request->metodCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Metodología'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Elementos de administración y control', $request->admCtrCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Elementos de administración y control'),
            ],
            //
            [
                'calificacion' => $this->calcularCalificacion('Normas de presentación en el documento y referencias bibliográficas', $request->normBibliCalificacion, 'anteproyecto', $request->cant . str_replace(" ", "", $clave[0]), $request,0, $names),
                'cal_item' => $this->buscarIdItem('Normas de presentación en el documento y referencias bibliográficas'),
            ]
        ];
        return $dataCalificaciones;
    }

    public function buscarIdItem($item)
    { //busca el item en la base de datos y extrae su id
        $idItem = Item::where('item', $item)->first()->idItem;
        return $idItem;
    }

    public function calcularCalificacion($item, $select, $fase, $cantSubItems, $request, $numItem, $names)
    { //calcula la nota tipo double en base al item y a la opcion del select

        //dd($names);
        $idItem = $this->buscarIdItem($item);
        $ponderado = $fase == 'propuesta' ? PonderadosPropuesta::where('item_pond', $idItem)->first() : ($fase == 'anteproyecto' ? PonderadoAnteproyecto::where('item_pond', $idItem)->first() : null);

        if ($fase == "propuesta") {
                if ($select == "si") {
                    return $ponderado->ponderado;
                } else if ($select == "parcial") {
                    return round((($ponderado->ponderado) / 2.0), 2);
                } else if ($select == "no") {
                    return 0;
                }
            }
        else if($fase == "anteproyecto"){
                $totalCalificacion = 0;
                dd($cantSubItems);
                for ($caliItemGeneral = 0; $caliItemGeneral < $cantSubItems; $caliItemGeneral++) {

                    $nombreSubItem = $names[$caliItemGeneral].$caliItemGeneral;
                    dd($request->$nombreSubItem. $nombreSubItem);
                    if ($request->$nombreSubItem == "si") {
                        $totalCalificacion += ($ponderado->ponderado / $cantSubItems);

                    } else if ($request->$nombreSubItem == "parcial") {
                        $totalCalificacion += (($ponderado->ponderado / $cantSubItems) / 2.0);
                    } else if ($request->$nombreSubItem == "no") {
                        $totalCalificacion += 0;
                    }
                }
            }

    }

    public function cambioEstado($idfase, $fase)
    {
        $total = 0;

        $calificacionesAnterior = Calificacione::join('fase_cal_obs', 'fase_cal_obs.calificacion_fase', 'calificaciones.idCalificacion')
            ->where($fase, $idfase)
            ->get();

        foreach ($calificacionesAnterior as $calificacion) {
            $total += $calificacion->calificacion;
        }

        $propuesta = $fase == 'propuesta' ? FasePropuesta::findOrFail($idfase) : ($fase == 'anteproyecto' ? FaseAnteproyecto::findOrFail($idfase) : ($fase == 'proyectoFinal' ? FaseProyectosfinale::findOrFail($idfase) :
            FaseSustentacione::findOrFail($idfase)));
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
