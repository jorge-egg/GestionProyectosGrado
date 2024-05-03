<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Models\User;
use App\Models\SedePrograma;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedesFacultade;
use App\Models\UsuarioPrograma;
use Doctrine\DBAL\Schema\Table;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreusuariosRequest;
use App\Http\Requests\UpdateusuariosRequest;
use Illuminate\Routing\Matching\HostValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $usuarios = UsuariosUser::all();
        if ($request->has('view_deleted')) {
            $usuarios = UsuariosUser::onlyTrashed()->get();
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
        $sedes = Sede::all();
        $roles = Role::all();

        return view('Layouts.usuarios.create', compact('sedes', 'roles'));
    }
    public function getProgramasBySede($sedeId)
    {
        $programas = SedesFacultade::join('sede_programas', 'sede_programas.prog_facu', 'sedes_facultades.idFacultad')
            ->where('facu_sede', $sedeId)
            ->get();
        return response()->json($programas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreusuariosRequest  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Definir reglas de validación personalizadas
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'numeroDocumento' => 'required|numeric|unique:usuarios_users,numeroDocumento'
        ]);

        // Verificar si la validación ha fallado
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Si la validación pasa, continuar con el proceso de almacenamiento

        // Validaciones y creación de User
        $user = User::create([
            'usuario' => $request->input('numeroDocumento'),
            'password' => bcrypt($request->input('password')),
        ]);

        // Validaciones y creación de UsuariosUser
        $usuariosUser = UsuariosUser::create([
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'email' => $request->input('email'),
            'numeroCelular' => $request->input('numeroCelular'),
            'usua_sede' => $request->input('usua_sede'),
            'usua_users' => $user->id,
            'usua_estado' => 1,
        ]);
        $usuariosUser->numeroDocumento = $request->input('numeroDocumento');
        $usuariosUser->save();

        // Asignación del rol estudiante al usuario
        $user->assignRole('estudiante');

        // Creación de UsuarioPrograma
        $usuarioPrograma = UsuarioPrograma::create([
            'usuario' => $usuariosUser->numeroDocumento,
            'programa' => $request->input('programa'),
        ]);
        // Notificar éxito mediante sesión flash
        Session::flash('success', 'El usuario se ha creado exitosamente.');

        return view('welcome');
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
    public function update(UpdateusuariosRequest $request, $id)
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
        return redirect()->route('usuarios.index')->with('success', 'se restablecio el registro');
    }
    public function forcedelete($id)
    {
        $usuarios = UsuariosUser::onlyTrashed()->find($id);
        $usuarios->forcedelete();
        return redirect()->route('usuarios.index');
    }
    public function destroy($id)
    {
        UsuariosUser::find($id)->delete();
        return back()->with('success', 'se elimino el registro');
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
