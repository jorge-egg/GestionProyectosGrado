<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Models\SedesFacultade;
use App\Http\Requests\StorefacultadesRequest;


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
       // dd(session('idSede'));
       $id = 0;
        if($request->idSede){
            $id = $request->idSede;
        }else if(session('idSede')){
            $id = session('idSede');
        }

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
        if($id){
            $idSede = $id;
            SedesFacultade::create([
                'nombre' => $request->nombre,
                'facu_sede' => $idSede,
            ]);
            return redirect()->back()->with('success', 'Creado exitosamente');
        }else{
            return redirect()->back()->with('error', 'Error al crear');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function edit($idSede, $idFacultad)
    {
        $idFac = $idFacultad;
        $facultad = SedesFacultade::find($idFac);
        if($facultad){
            return view('Layouts.facultades.update', compact('facultad', 'idSede'));
        }
        return back()->with('error', 'Facultad no encontrada');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatefacultadesRequest  $request
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idFacultad, $idSede)
    {

        $request->validate([
            'nombre' => 'required|string|max:200|min:5'
        ]);
        try{
            $facultad = SedesFacultade::find($idFacultad);
            $facultad->update($request->all());

            return redirect()->route('facultades.index')->with(['success' => 'Registro actualizado exitosamente', 'idSede' => $idSede]);
        }catch(Throwable $e){
            return redirect()->route('facultades.index')->with(['error' => 'Error al actualizar el registro, intente nuevamente mas tarde', 'idSede' => $idSede]);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\facultades  $facultades
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
