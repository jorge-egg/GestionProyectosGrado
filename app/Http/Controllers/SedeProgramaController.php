<?php

namespace App\Http\Controllers;

use App\Models\SedePrograma;
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
        $programas = SedePrograma::all();
        if($request->has('view_deleted')){
            $programas = SedePrograma::onlyTrashed()->get();
        }
        return view('Layouts.programas.index', compact('programas'));
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
