<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UsuariosUser;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreusuariosRequest;
use App\Http\Requests\UpdateusuariosRequest;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = UsuariosUser::paginate(10);
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
    public function destroy(UsuariosUser $usuarios)
    {
        //
    }
}
