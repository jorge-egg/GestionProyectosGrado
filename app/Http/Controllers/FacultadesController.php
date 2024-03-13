<?php

namespace App\Http\Controllers;

use App\Models\facultades;
use App\Models\SedesFacultade;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\StorefacultadesRequest;
use Illuminate\Http\Request;


class FacultadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->idSede;
        $facultades = SedesFacultade::where('facu_sede', $id)->get();
        return view('Layouts.facultades.read',compact('facultades', 'id'));
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
     * @param  \App\Http\Requests\StorefacultadesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefacultadesRequest $request, $id)
    {

        $request->validate([
            'nombre' => 'required|min:5',
        ]);

        $idSede = $id;
        SedesFacultade::create([
            'nombre' => $request->nombre,
            'facu_sede' => $idSede,
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function show(facultades $facultades)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function edit(facultades $facultades)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefacultadesRequest  $request
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatefacultadesRequest $request, facultades $facultades)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function destroy(facultades $facultades)
    {
        //
    }
}
