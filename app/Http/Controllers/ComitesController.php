<?php

namespace App\Http\Controllers;

use App\Models\comites;
use App\Http\Requests\StorecomitesRequest;
use App\Http\Requests\UpdatecomitesRequest;

class ComitesController extends Controller
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
     * @param  \App\Http\Requests\StorecomitesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecomitesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comites  $comites
     * @return \Illuminate\Http\Response
     */
    public function show(comites $comites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comites  $comites
     * @return \Illuminate\Http\Response
     */
    public function edit(comites $comites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecomitesRequest  $request
     * @param  \App\Models\comites  $comites
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecomitesRequest $request, comites $comites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comites  $comites
     * @return \Illuminate\Http\Response
     */
    public function destroy(comites $comites)
    {
        //
    }
}
