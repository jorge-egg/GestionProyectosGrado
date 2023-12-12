<?php

namespace App\Http\Controllers;
use App\Models\ComitesSede;
use App\Models\SedePrograma;
use App\Models\SedesFacultade;
use Illuminate\Http\Request;

class SedeProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Obtener programas de la sede seleccionada

        $idSede = $request->idSede;
        $programas = SedePrograma::where('prog_sede', $idSede)->get();
        $facultades = SedesFacultade::where('facu_sede', $idSede)->get();
        return view('Layouts.programas.index', compact('programas', 'idSede','facultades'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $idSede)
    {
        $request->validate([
            'programa' => 'required',
            'siglas' => 'required',
            'prog_facu' => 'required',
        ]);

        // Validar y almacenar el nuevo programa
        $programa = SedePrograma::create([
            'programa' => $request->programa,
            'siglas' => $request->siglas,
            'prog_facu' => $request->prog_facu,
            'prog_sede' => $idSede,
        ]);

        // Crear entrada en la tabla comites_sedes
        $comite = ComitesSede::create([
            'comi_pro' => $programa->idPrograma,
        ]);

        return redirect()->back();
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
        $programas = SedePrograma::findOrFail($id);
        return view('programa.edit', compact('programas'));
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
        $programas = SedePrograma::findOrFail($id);
        $programas->update($request->all());
        return redirect()->route('programa.index');
    }
    public function restore($id)
    {
        SedePrograma::withTrashed()->find($id)->restore();
        return redirect()->route('programa.index')->with('success','se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $programas=SedePrograma::onlyTrashed()->find($id);
        $programas->forcedelete();
        return redirect()->route('programa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    SedePrograma::find($id)->delete();
    return back()->with('success','se elimino el registro');
    }
}
