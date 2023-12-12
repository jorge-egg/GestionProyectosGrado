<?php

namespace App\Http\Controllers;
use App\Models\IntegrantesComite;
use App\Models\UsuariosUser;
use App\Models\User;
use App\Http\Requests\StorecomitesRequest;
use App\Http\Requests\UpdatecomitesRequest;
use App\Models\ComitesSede;
use Illuminate\Http\Request;


class ComitesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $comites = ComitesSede::all();
        if($request->has('view_deleted')){
            $comites=ComitesSede::onlyTrashed()->get();
        }
        return view('Layouts.comites.index', compact('comites'));
    }
    public function createIntegrante()
    {
        $docentes = User::role('docente')->get();
        
        return view('Layouts.comites.create-integrante', compact('docentes'));
    }

    public function storeIntegrante(Request $request)
{
    $request->validate([
        'docente' => 'required|exists:users,id',
    ]);

    $docente = User::find($request->input('docente'));
    $docente->assignRole('comite');

    IntegrantesComite::create([
        'usuario' => $docente->numeroDocumento,
        'comite' => idComite,
    ]);

    return redirect()->route('comite.index')->with('success', 'Integrante añadido exitosamente');
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
     * @param  \App\Models\ComitesSede  $comites
     * @return \Illuminate\Http\Response
     */
    public function edit(ComitesSede $comites)
    {
        return view('Layouts.comites.update');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecomitesRequest  $request
     * @param  \App\Models\ComitesSede  $comites
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComitesSedeRequest $request, ComitesSede $comites)
    {
        //
    }
    public function restore($id)
    {
        ComitesSede::withTrashed()->find($id)->restore();
        return redirect()->route('comite.index')->with('success','se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $usuarios=ComitesSede::onlyTrashed()->find($id);
        $usuarios->forcedelete();
        return redirect()->route('comite.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComitesSede  $comites
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    ComitesSede::find($id)->delete();
    return back()->with('success','se elimino el registro');
    }
}
