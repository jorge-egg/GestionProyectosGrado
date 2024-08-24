<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FasePropuesta;
use App\Models\FaseAnteproyecto;
use App\Models\FaseSustentacione;
use App\Models\SedeProyectosGrado;
use App\Models\FaseProyectosfinale;

class bibliotecaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectosSinVerif = SedeProyectosGrado::where('estado', false)->get();

        $array = [];
        foreach ($proyectosSinVerif as $proyecto) {

            if ($this->validarEstadoFases($proyecto->idProyecto)) {
                array_push($array, $proyecto);
            }
        }

        $proyectos = (object) $array;
        return view('Layouts.biblioteca.index', compact('proyectos'));
    }

    public function validarEstadoFases($idProyecto)
    {
        $propuesta = FasePropuesta::where('prop_proy', $idProyecto);
        if ($propuesta->exists()) {

            $anteproyecto = FaseAnteproyecto::where('ante_proy', $idProyecto);

            if ($anteproyecto->exists()) {

                $proyectoFinal = FaseProyectosfinale::where('pfin_proy', $idProyecto)->orderBy('idProyectofinal', 'desc');
                
                if ($proyectoFinal->exists() && $proyectoFinal->first()->estado == 'Aprobado') {

                    $sustentacion = FaseSustentacione::where('sust_proy', $idProyecto)->orderBy('idSustentacion', 'desc');
                    if ($sustentacion->exists() && $sustentacion->first()->estado == 'Aprobado') {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
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
