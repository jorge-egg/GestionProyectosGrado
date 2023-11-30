<?php

namespace App\Http\Controllers;

use App\Models\FaseCalOb;
use App\Models\FasePropuesta;
use App\Models\ObservacionesCalificacione;
use Error;
use Exception;
use Illuminate\Http\Request;

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
        $propuestaAnterior = $this->ultimaPropuesta($idProyecto);
        $observaciones = $this->ultimaObservacion($propuestaAnterior->idPropuesta);


        return view('Layouts.propuesta.create', compact('idProyecto', 'propuestaAnterior'));
    }

    //consultar si existen propuestas creadas por el usuario y tomar la ultima
    public function ultimaPropuesta($idProyecto)
    {
        $propuestaAnterior = FasePropuesta::where('prop_proy', $idProyecto)->orderBy('idPropuesta', 'desc')->first();
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
        try{
            $observacionesAnterior = ObservacionesCalificacione::join('fase_cal_obs', 'fase_cal_obs.observacion_fase', 'observaciones_calificaciones.idObservacion')
            ->where('propuesta', $idPropuesta)
            ->get();
        }catch(Exception $e){
            $observacionesAnterior = (object) array(
                'idPropuesta' => "",
                'titulo' => "",
                'linea_invs' => "",
                'desc_problema' => "",
                'obj_general' => "",
                'obj_especificos' => "",
                'estado' => "Activo"
            );
        }

        
        return $observacionesAnterior;
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


        // $propuestas = new FasePropuesta();
        // $propuestas->titulo = $request->post('titulo');
        // $propuestas->linea_invs = $request->post('linea_invs');
        // $propuestas->desc_problema = $request->post('desc_problema');
        // $propuestas->obj_general = $request->post('obj_general');
        // $propuestas->obj_especificos = $request->post('obj_especificos');
        // //$propuestas->estado = $request->post('estado');
        // // $propuestas->fecha_cierre = $request->post('fecha_cierre');
        // // $propuestas->prop_fase = $request->post('prop_fase');
        // $propuestas->save();
        return redirect()->route('proyecto.indextable')->with('success', 'Se ha agregado con exito');
    }

    public function verificarCantProp($idProyecto)
    {
        $cantidad = FasePropuesta::where('prop_proy', $idProyecto)->get()->count();
        $validacion = $cantidad < 2 ? true : false;
        return  $validacion;
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
