<?php

namespace App\Http\Controllers;

use App\Models\FaseAnteproyecto;
use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedeProyectosGrado;
use App\Traits\funcionesUniversales;

class FaseAnteproyectosController extends Controller
{
    use funcionesUniversales;
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
        $anteproyectoAnterior = FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'desc')->first();
        $anteproyecto = $this->Anteproyecto($anteproyectoAnterior);
        $docExist = $anteproyectoAnterior == null ? null : ($anteproyectoAnterior->exists() ? $anteproyectoAnterior->documento : null);
        $observaciones = $this->ultimaObservacion($anteproyecto->idAnteproyecto, 'anteproyecto', 8);
        $valExistDocent = ($proyecto->docente) == null ? false : true; //valida si ya se asigno un docente al proyecto
        $docente        = $valExistDocent ? UsuariosUser::findOrFail($proyecto->docente) : null;
        $docenteAsig    = $valExistDocent ? $docente->nombre . " " . $docente->apellido : null;
        $array = array(
            'idProyecto' => $idProyecto,
            'observaciones' => $observaciones,
            'docentes' => $docentes,
            'valExistDocent' => $valExistDocent,
            'docenteAsig' => $docenteAsig,
            'docExist' => $docExist,
            'anteproyecto' => $anteproyecto
        );

        return view('Layouts.anteproyecto.create', compact('array'));
    }

    public function docentes()
    { //busca a todos los usuarios con rol de docente
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

    public function asignarDocente(Request $request)
    {//guarda un docente en la base de datos par el proyecto
        $idProyecto = $request->idProyecto;
        $numeroDocumento = $request->numeroDocumento;
        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);
        $proyecto->docente = $numeroDocumento;
        $proyecto->save();

        return redirect()->route('anteproyecto.create', ['idProyecto'=>$idProyecto]);
    }

    public function verPdf($nombreArchivo)
    { //retorna el pdf
        $rutaArchivo = public_path('files/anteproyecto/'.$nombreArchivo);

        // Verificar si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Devolver el archivo para ser mostrado en el navegador
            return response()->file($rutaArchivo);
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }

    //consultar si existen propuestas creadas por el usuario y tomar la ultima
    public function Anteproyecto($anteproyectoAnterior)
    {
        if ($anteproyectoAnterior == null) {
            $anteproyectoAnterior = (object) array(
                'idAnteproyecto' => "",
                'documento' => "",
                'aprobacionDocen' => "",
                'estado' => "Activo"
            );
        }
        return $anteproyectoAnterior;
    }

    public function aprobarDoc(Request $request)
    { //cambia el estado en la base de datos de la aprobacion del documento
        $idProyecto = $request->idProyecto;
        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyecto = FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderByDesc('idAnteproyecto')->first();
        if($request->input('switchAprobDoc')){
            $anteproyecto->aprobacionDocen = true;
            $anteproyecto->save();
        }else{
            $anteproyecto->aprobacionDocen = false;
            $anteproyecto->save();
        }
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
            'docAnteProy' => 'required|mimes:pdf|max:3048', // Solo permite archivos PDF de hasta 2MB
        ]);

        $proyecto = SedeProyectosGrado::findOrFail($request->idProyecto);
        $contador = FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->count();
        if($request->hasFile("docAnteProy")){
            $file = $request->file("docAnteProy");
            $newNameFile = $proyecto->codigoproyecto . "AP".$contador."." . $file->guessExtension();
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
