<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsuariosUser;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Routing\Matching\HostValidator;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreusuariosRequest;
use App\Http\Requests\UpdateusuariosRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
        $usuarios = UsuariosUser::paginate(10);
        if($request->has('view_deleted')){
            $usuarios=UsuariosUser::onlyTrashed()->get();
        }
   
        return view('Layouts.usuarios.read', compact('usuarios'));
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
     * @param  \App\Http\Requests\StoreusuariosRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreusuariosRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuariosUser  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuariosUser  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = UsuariosUser::findOrFail($id);
        return view('Layouts.usuarios.update', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateusuariosRequest  $request
     * @param  \App\Models\UsuariosUser  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateusuariosRequest $request,$id)
    {
        $usuarios = UsuariosUser::findOrFail($id);
        $usuarios->update($request->all());

        $user = User::findOrFail($request->usua_users);
        $user->roles()->sync($request->roles);

        return redirect()->route('usuarios.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuariosUser  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        UsuariosUser::withTrashed()->find($id)->restore();
        return redirect()->route('usuarios.index')->with('success','se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $usuarios=UsuariosUser::onlyTrashed()->find($id);
        $usuarios->forcedelete();
        return redirect()->route('usuarios.index');
    }
    public function destroy($id)
    {
    UsuariosUser::find($id)->delete();
    return back()->with('success','se elimino el registro');
    }
    public function cambioEstado($id)
    {
        $user = User::findOrFail($id);
        if ($user->estado) {
            $user->estado = false;
            $user->save();
        } else {
            $user->estado = true;
            $user->save();
        }

        return redirect()->route('usuarios.index');
    }
}
