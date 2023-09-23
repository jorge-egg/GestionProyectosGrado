<?php

namespace App\Http\Controllers;

use App\Models\facultades;
use App\Http\Requests\StorefacultadesRequest;
use App\Http\Requests\UpdatefacultadesRequest;

class FacultadesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorefacultadesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorefacultadesRequest $request)
    {
        //
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
