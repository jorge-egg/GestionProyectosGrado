<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ModelHasRole;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\FaseAnteproyecto;
use App\Models\SedeProyectosGrado;
use App\Traits\funcionesUniversales;
use Illuminate\Support\Facades\Auth;

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
        //$docentes       = $this->docentes();
        $proyecto       = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyectoAnterior = FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'desc')->first();
        $anteproyecto = $this->Anteproyecto($anteproyectoAnterior);
        $docExist = $anteproyectoAnterior == null ? null : ($anteproyectoAnterior->exists() ? $anteproyectoAnterior->documento : null);
        $observaciones = $this->ultimaObservacion($anteproyecto->idAnteproyecto, 'anteproyecto', 8);
        $rangoFecha = $this->rangoFecha('anteproyecto');
        $valDocAsig = $proyecto->docente == Auth::user()->usuario ? true : false; //verfica si el usuario en sesion es el docente asignado
        $miembrosComite = $this->obtMiembrosComite($this->$idProyecto );
        $array = array( //array que transportara todos los datos a la view
            'idProyecto' => $idProyecto,
            'observaciones' => $observaciones,
            'anteproyecto' => $anteproyecto,
            'rangoFecha' => $rangoFecha,
            'valDocAsig' => $valDocAsig,
            'docExist' => $docExist,
            'miembrosComite' => $miembrosComite,
        );

        return view('Layouts.anteproyecto.create', compact('array'));
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
            $anteproyecto->aprobacionDocen = '2'; //estado de aprobado
            $anteproyecto->save();
        }else{
            $anteproyecto->aprobacionDocen = '1'; //estado de No aprobado
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
                'aprobacionDocen' => '-1', //Sin valor definido
                'estado' => 'Activo',
                'ante_proy' => $proyecto->idProyecto,

            ]);
        }
        return redirect()->back();
    }

}
