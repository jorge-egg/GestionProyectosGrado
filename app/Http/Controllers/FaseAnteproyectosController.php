<?php

namespace App\Http\Controllers;

use App\Models\FaseAnteproyecto;
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedeProyectosGrado;

class FaseAnteproyectosController extends Controller
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
    public function create(Request $request, $idProyecto)
    {
        $this->$idProyecto     = $idProyecto;
        $docentes       = $this->docentes();
        $proyecto       = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyecto   = FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderBy('idAnteproyecto', 'asc')->first();
        $docExist       = $anteproyecto->exists() ? $anteproyecto->documento : null;
        dd($docExist);
        $valExistDocent = ($proyecto->docente) == null ? false : true; //valida si ya se asigno un docente al proyecto
        $docente        = $valExistDocent ? UsuariosUser::findOrFail($proyecto->docente) : null;
        $docenteAsig    = $valExistDocent ? $docente->nombre . " " . $docente->apellido : null;

        return view('Layouts.anteproyecto.create', compact('idProyecto','docentes','valExistDocent', 'docenteAsig'));
    }

    public function docentes(){ //busca a todos los usuarios con rol de docente
        $array = [];
        //$usuario     = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        //$filtroRole  = ModelHasRole::join('roles', 'roles.id', 'model_has_roles.role_id')->where('name', 'docente')->get();
        $usuarios = User::all();
        foreach($usuarios as $usuario){
            $docentesRole    = $usuario->roles()->get();
            foreach($docentesRole as $rol){
                if($rol->name == 'docente'){
                    $usuarioUser = UsuariosUser::join('sedes', 'sedes.idSede', 'usuarios_users.usua_sede')->where('usua_users', $usuario->id)->whereNull('deleted_at')->first();
                    array_push($array, $usuarioUser);
                }
            }
        }
        return $array;
    }

    public function asignarDocente(Request $request){//guarda un docente en la base de datos par el proyecto
        $idProyecto = $request->idProyecto;
        $numeroDocumento = $request->numeroDocumento;
        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);
        $proyecto->docente = $numeroDocumento;
        $proyecto->save();

        return redirect()->route('anteproyecto.create', ['idProyecto'=>$idProyecto]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'docAnteProy' => 'required|mimes:pdf|max:2048', // Solo permite archivos PDF de hasta 2MB
        ]);

        $proyecto = SedeProyectosGrado::findOrFail($request->idProyecto);
        if($request->hasFile("docAnteProy")){
            $file = $request->file("docAnteProy");
            $newNameFile = $proyecto->codigoproyecto . "AP." . $file->guessExtension();
            $ruta = public_path('files/anteproyecto/'.$newNameFile);
            copy($file, $ruta);
            FaseAnteproyecto::create([
                'documento' => $newNameFile,
                'ante_proy' => $proyecto->idProyecto,
            ]);
        }
        return redirect()->back();
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
