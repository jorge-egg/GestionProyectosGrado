<?php

namespace App\Http\Controllers;

use App\Models\IntegrantesComite;
use App\Models\UsuariosUser;
use App\Models\User;
use App\Http\Requests\StorecomitesRequest;
use App\Http\Requests\UpdatecomitesRequest;
use App\Models\ComitesSede;
use App\Models\Sede;
use App\Models\SedePrograma;
use App\Models\SedesFacultade;
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
        $comites = Sede::join('sedes_facultades', 'sedes_facultades.facu_sede', 'sedes.idSede')
            ->join('sede_programas', 'sede_programas.prog_facu', 'sedes_facultades.idFacultad')
            ->join('comites_sedes', 'comites_sedes.comi_pro', 'sede_programas.idPrograma')
            ->get();
        if ($request->has('view_deleted')) {
            $comites = ComitesSede::onlyTrashed()->get();
        }
        return view('Layouts.comites.index', compact('comites'));
    }
    public function createIntegrante($idComite)
    {
        $integrantes = IntegrantesComite::join('usuarios_users', 'usuarios_users.numeroDocumento', 'integrantes_comites.usuario')->where('comite', $idComite)->get(); //obtiene los miembros de un comite en especifico

        $docentes = User::role('docente')
            ->join('usuarios_users', 'usuarios_users.usua_users', 'users.id')
            ->select(['usuarios_users.numeroDocumento', 'usuarios_users.nombre', 'usuarios_users.apellido', 'users.id'])
            ->get();

        return view('Layouts.comites.create-integrante', compact('docentes', 'idComite', 'integrantes'));
    }

    public function storeIntegrante(Request $request)
    {
        $docente = User::findOrFail($request->input('docente'));
        $docente->assignRole('comite');
        $idComite = $request->idComite;
        $numeroDocumento = UsuariosUser::where('usua_users', $docente->id)->first()->numeroDocumento;
        IntegrantesComite::create([
            'usuario' => $numeroDocumento,
            'comite' => $idComite,
        ]);

        return redirect()->route('comite.index')->with('success', 'Integrante añadido exitosamente');
    }

    public function restore($id)
    {
        ComitesSede::withTrashed()->find($id)->restore();
        return redirect()->route('comite.index')->with('success', 'se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $usuarios = ComitesSede::onlyTrashed()->find($id);
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
        IntegrantesComite::where('usuario', $id)->delete();
        return back()->with('warning', 'se elimino el registro');
    }
}
