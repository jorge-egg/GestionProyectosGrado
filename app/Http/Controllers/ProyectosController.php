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
        $consecutivo = 0;
        $anoActual   = Carbon::now()->format('Y');
        $usuario     = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $programa    = SedePrograma::all()->where('prog_usua', $usuario->numeroDocumento)->first();
        if($anoReferencia < $anoActual){
            $anoReferencia = $anoActual;
            $consecutivo = 0;
        }else{
            $consecutivo++;
        }


        dd($programa->siglas.$consecutivo.$anoActual);
        /*SedeProyectosGrado::create([
            'estado' => 'En proceso',
            'codigoproyecto' => $programa->siglas.$consecutivo.$año,
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
