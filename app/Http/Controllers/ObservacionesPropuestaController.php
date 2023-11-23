<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ObservacionesCalificacione;
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
        dd($this->buscarIdItem('Titulo'));

        ObservacionesCalificacione::create([
            'observacion' => $request->tituloObservacion,
            'obs_item' => $this->buscarIdItem('Titulo'),
            //
            'observacion' => $request->lineaObservacion,
            'obs_item' => $this->buscarIdItem('Linea de investigación'),
            //
            'observacion' => $request->descProbObservacion,
            'obs_item' => $this->buscarIdItem('Descripción del problema'),
            //
            'observacion' => $request->objGenObservacion,
            'obs_item' => $this->buscarIdItem('Objetivo general'),
            //
            'observacion' => $request->objEspObservacion,
            'obs_item' => $this->buscarIdItem('Objetivos especificos'),
        ]);
    }

    public function buscarIdItem($item){
        $idTitulo = Item::where('item', $item)->first()->idItem;
        return $idTitulo;
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
