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
        if ($request->idSede) {
            $idSede = $request->idSede;
        } else if (session('idSede')) {
            $idSede = session('idSede');
        }

        $programas = SedesFacultade::join('sede_programas', 'sede_programas.prog_facu', 'sedes_facultades.idFacultad')
            ->where('facu_sede', $idSede)
            ->get();
        //dd($programas);
        return view('Layouts.programas.index', compact('programas', 'idSede'));
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
    public function store(Request $request)
    {
        $request->validate([
            'programa' => 'required',
            'siglas' => 'required',
            'prog_facu' => 'required',
            'email' => 'required|email|string|max:255'
        ]);

        // Validar y almacenar el nuevo programa
        $programa = SedePrograma::create([
            'programa' => $request->programa,
            'siglas' => $request->siglas,
            'prog_facu' => $request->prog_facu,
            'email' => $request->email,
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
    public function edit($id, $idSede)
    {
        $programas = SedePrograma::findOrFail($id);
        return view('Layouts.programas.update', compact('programas', 'idSede'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idSede)
    {
        $programas = SedePrograma::findOrFail($id);
        $programas->update($request->all());
        return redirect()->route('programas.index')->with('idSede', $idSede);
    }
    public function restore($id)
    {
        SedePrograma::withTrashed()->find($id)->restore();
        return redirect()->route('programa.index')->with('success', 'se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $programas = SedePrograma::onlyTrashed()->find($id);
        $programas->forcedelete();
        return redirect()->route('programa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idSede)
    {
       // Buscar el registro por su ID
       $idSede = $id;
       $programa = SedePrograma::findOrFail($idSede);
    if ($programa->idPrograma) {
        $programa->delete();
        return back()->with([
            'success' => 'Se eliminó el registro',
            'idSede' => $idSede
        ]);
    }

    return back()->with([
        'success' => 'Error 404 - El registro no se encontró',
        'idSede' => $idSede

    ]);
    }
}
