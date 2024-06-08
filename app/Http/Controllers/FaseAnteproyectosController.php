<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FaseAnteproyecto;
use App\Models\SedeProyectosGrado;
use App\Models\Integrante;
use App\Traits\funcionesUniversales;

use Illuminate\Support\Facades\Auth;

class FaseAnteproyectosController extends Controller
{
    use funcionesUniversales;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $idProyecto)
    {
        $this->$idProyecto      = $idProyecto;
        $integrantes            = Integrante::where('proyecto', $idProyecto)->with('usuarios_user')->get();
        $proyecto               = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyectoAnterior   = FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'asc')->first();
        $consultAnteproy        = FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'desc')->first();
        $anteproyecto           = $this->Anteproyecto($consultAnteproy);
        $docExist1              = $consultAnteproy == null ? null : ($consultAnteproy->exists() ? $consultAnteproy->documento : null);
        $docExist2              = $consultAnteproy == null ? null : ($consultAnteproy->exists() ? $consultAnteproy->cartaDirector : null);
        $observaciones          = $this->ultimaObservacion($anteproyecto->idAnteproyecto, 'anteproyecto', 8);

        $itemsSubItems          = $this->buscarNombresItems('anteproyecto');
        $rangoFecha             = $this->rangoFecha('anteproyecto');
        $valDocAsig             = $proyecto->docente == Auth::user()->usuario ? true : false; //verfica si el usuario en sesion es el docente asignado
        $miembrosDocente        = $this->obtenerDocentes($this->$idProyecto );
        $array                  = array( //array que transportara todos los datos a la view
                                    'idProyecto' => $idProyecto,
                                    'observaciones' => $observaciones,
                                    'anteproyecto' => $anteproyecto,
                                    'rangoFecha' => $rangoFecha,
                                    'valDocAsig' => $valDocAsig,
                                    'docExist1' => $docExist1,
                                    'docExist2' => $docExist2,
                                    'integrantes' => $integrantes,
                                    'nameItems' => $itemsSubItems,
                                    'anteproyectoAnterior' => $anteproyectoAnterior,
                                );
                                //dd($array['anteproyectoAnterior']);

        return view('Layouts.anteproyecto.create', compact('array', 'miembrosDocente'));
    }





    public function verPdf($nombreArchivo, $ruta)
    { //retorna el pdf
        if($ruta == '1'){
            $rutaArchivo = public_path('files/anteproyecto/'.$nombreArchivo);
        }else if($ruta == '2'){
            $rutaArchivo = public_path('files/directorCarta/'.$nombreArchivo);
        }


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
            $anteproyecto->observaDocent = $request->ObsDocent;
            $anteproyecto->save();
        }else{
            $anteproyecto->aprobacionDocen = '1'; //estado de No aprobado
            $anteproyecto->observaDocent = $request->ObsDocent;
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
            'docAnteProy' => 'required|mimes:pdf|max:3048',
            'docDir' => 'required|mimes:pdf|max:3048', // Solo permite archivos PDF de hasta 2MB
        ]);

        $proyecto = SedeProyectosGrado::findOrFail($request->idProyecto);
        $contador = FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->count();
        if($request->hasFile("docAnteProy") && $request->hasFile("docDir")){
            $file1 = $request->file("docAnteProy");
            $file2 = $request->file("docDir");
            $newNameFile1 = $proyecto->codigoproyecto . "AP".$contador."." . $file1->guessExtension();
            $newNameFile2 = $proyecto->codigoproyecto . "AP".$contador."." . $file2->guessExtension();
            $ruta1 = public_path('files/anteproyecto/'.$newNameFile1);
            $ruta2 = public_path('files/directorCarta/'.$newNameFile2);
            copy($file1, $ruta1);
            copy($file2, $ruta2);

            FaseAnteproyecto::create([
                'documento' => $newNameFile1,
                'cartaDirector' => $newNameFile2,
                'aprobacionDocen' => '-1', //Sin valor definido
                'juradoUno' => '-1',
                'juradoDos' => '-1',
                'estadoJUno' => 'Pendiente',
                'estadoJDos' => 'Pendiente',
                'estado' => 'Activo',
                'ante_proy' => $proyecto->idProyecto,

            ]);
        }
        return redirect()->back();
    }

    public function asigJurado(Request $request){
        $idProyecto = $request -> idProyecto;

        $numJurado = $request-> JIdentificador;

        $numeroDocumento = $request -> numeroDocumento;

        $this->asignarJurado($idProyecto, $numeroDocumento, 'anteproyecto', $numJurado);
        return redirect()->route('anteproyecto.create', ['idProyecto'=>$idProyecto]);
    }

}
