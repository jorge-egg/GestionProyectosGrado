<?php

namespace App\Http\Controllers;

use App\Models\FasePropuesta;
use Error;
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
     $propuestas = FasePropuesta::all();
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
        return view('Layouts.propuesta.create', compact('idProyecto'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $propuesta = FasePropuesta::create([
            'titulo'          => $request->titulo,
            'linea_invs'      => $request->linea_invs,
            'desc_problema'   => $request->desc_problema,
            'estado'          => 'pendiente',
            'prop_proy'       => $request->idProyecto,
            'obj_general'     => $request->obj_general,
            'obj_especificos' => $request->obj_especificos
        ]);

        if ( !$propuesta ) {
            return back()->with('error', 'hubo un error al crear el registro');
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
        return redirect()->route('proyecto.indextable')->with('success','Se ha agregado con exito');
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
