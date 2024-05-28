<?php

namespace App\Http\Controllers;

use App\Models\Integrante;
use Illuminate\Http\Request;
use App\Models\FaseAnteproyecto;
use App\Models\SedeProyectosGrado;
use App\Models\FaseProyectosfinale;
use App\Traits\funcionesUniversales;
use Illuminate\Support\Facades\Auth;

class FaseProyectoFinalController extends Controller
{
    use funcionesUniversales;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $idProyecto)
    {

        $this->$idProyecto      = $idProyecto;
        $integrantes            = Integrante::where('proyecto', $idProyecto)->with('usuarios_user')->get();
        $proyecto               = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyectoAnterior   = FaseProyectosfinale::where('pfin_proy', $idProyecto)->orderBy('idProyectofinal', 'desc')->first();
        //dd($anteproyectoAnterior);
        $anteproyecto           = $this->proyectoFinal($anteproyectoAnterior);
        //dd($anteproyecto);
        $docExist1              = $anteproyectoAnterior == null ? null : ($anteproyectoAnterior->exists() ? $anteproyectoAnterior->documento : null);
        //dd($anteproyecto);
        $observaciones          = $this->ultimaObservacion($anteproyecto->idProyectofinal, 'proyecto_final', 8);
        $itemsSubItems          = $this->buscarNombresItems('proyFinal');
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
                                    'integrantes' => $integrantes,
                                    'nameItems' => $itemsSubItems,
                                );
                                //dd($array['observaciones']);

        return view('Layouts.proyectoFinal.create', compact('array', 'miembrosDocente'));
    }



    //consultar si existen proyectos finales creados por el usuario y tomar la ultima
    public function proyectoFinal($proyectoFinal)
    {
        if ($proyectoFinal == null) {
            $proyectoFinal = (object) array(
                'idProyectofinal' => "",
                'documento' => "",
                'aprobacionDocen' => "",
                'estado' => "Activo"
            );
        }
        return $proyectoFinal;
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
            'docAnteProy' => 'required|mimes:pdf|max:3048'
        ]);

        $proyecto = SedeProyectosGrado::findOrFail($request->idProyecto);
        $contador = FaseProyectosfinale::where('pfin_proy', $proyecto->idProyecto)->count();
        if($request->hasFile("docAnteProy")){
            $file1 = $request->file("docAnteProy");
            $newNameFile1 = $proyecto->codigoproyecto . "PF".$contador."." . $file1->guessExtension();
            $ruta1 = public_path('files/proyFinal/'.$newNameFile1);
            copy($file1, $ruta1);
            FaseProyectosfinale::create([
                'documento' => $newNameFile1,
                'aprobacionDocen' => '-1', //Sin valor definido
                'juradoUno' => FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoUno,
                'juradoDos' => FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoDos,
                'estadoJUno' => 'Pendiente',
                'estadoJDos' => 'Pendiente',
                'estado' => 'Activo',
                'pfin_proy' => $proyecto->idProyecto,

            ]);
        }
        return redirect()->back();
    }



    public function verPdf($nombreArchivo, $ruta)
    { //retorna el pdf

            $rutaArchivo = public_path('files/proyFinal/'.$nombreArchivo);


        // Verificar si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Devolver el archivo para ser mostrado en el navegador
            return response()->file($rutaArchivo);
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }



    public function aprobarDoc(Request $request)
    { //cambia el estado en la base de datos de la aprobacion del documento

        $idProyecto = $request->idProyecto;

        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);

        $proyectoFinal = FaseProyectosfinale::where('pfin_proy', $proyecto->idProyecto)->orderByDesc('idProyectofinal')->first();

        if($request->input('switchAprobDoc')){
            $proyectoFinal->aprobacionDocen = '2'; //estado de aprobado
            $proyectoFinal->observaDocent = $request->ObsDocent;
            $proyectoFinal->save();
        }else{
            $proyectoFinal->aprobacionDocen = '1'; //estado de No aprobado
            $proyectoFinal->observaDocent = $request->ObsDocent;
            $proyectoFinal->save();
        }

        return redirect()->route('proyectoFinal.create', ['idProyecto'=>$idProyecto]);


    }


    public function asigJurado(Request $request){
        $idProyecto = $request -> idProyecto;
        $numeroDocumento = $request -> numeroDocumento;
        $this->asignarJurado($idProyecto, $numeroDocumento, 'proFinal');
        return redirect()->route('proyectoFinal.create', ['idProyecto'=>$idProyecto]);
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
