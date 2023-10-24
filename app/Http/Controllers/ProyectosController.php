<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SedePrograma;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedeProyectosGrado;

class ProyectosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Layouts.proyecto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuario     = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $programa    = SedePrograma::where('prog_usua', $usuario->numeroDocumento)->get('programa');
        $consecutivo = 1;
        $año         = Carbon::now()->format('Y');
        dd($año);
        /*SedeProyectosGrado::create([
            'estado' => 'En proceso',
            'codigoproyecto' => $programa.$consecutivo.$año,
        ]);*/
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
