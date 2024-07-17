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
        $consultanteproyectoAnt = FaseProyectosfinale::where('pfin_proy', $idProyecto)->orderBy('idProyectofinal', 'asc')->first();;
        $consultAnteproy        = FaseProyectosfinale::where('pfin_proy', $idProyecto)->orderBy('idProyectofinal', 'desc')->first();;
        $anteproyecto           = $this->proyectoFinal($consultAnteproy, $this->$idProyecto );
        $anteproyectoAnterior   = $this->proyectoFinal($consultanteproyectoAnt, $this->$idProyecto );
        $docExist1              = $consultAnteproy == null ? null : ($consultAnteproy->exists() ? $consultAnteproy->documento : null);
        $docExist2              = $consultAnteproy == null ? null : ($consultAnteproy->exists() ? $consultAnteproy->cartaDirector : null);
        //dd($anteproyecto);
        $observaciones          = $this->ultimaObservacion($anteproyecto->idProyectofinal, 'proyecto_final', 8);
        $itemsSubItems          = $this->buscarNombresItems('proyFinal');
        $rangoFecha             = $this->rangoFecha('proyectoFinal');
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
                                //dd($array['observaciones']);

        return view('Layouts.proyectoFinal.create', compact('array', 'miembrosDocente'));
    }



    //consultar si existen proyectos finales creados por el usuario y tomar la ultima
    public function proyectoFinal($proyectoFinal, $idProyecto)
    {
        if ($proyectoFinal == null) {
            $proyectoFinal = (object) array(
                'idProyectofinal' => "",
                'documento' => "",
                'juradoUno' => FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoUno,
                'juradoDos' => FaseAnteproyecto::where('ante_proy', $idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoDos,
                'estadoJUno' => 'Pendiente',
                'estadoJDos' => 'Pendiente',
                'aprobacionDocen' => "",
                'estado' => "Activo",
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
            'docAnteProy' => 'required|mimes:pdf|max:3048',
            'docDir' => 'required|mimes:pdf|max:3048',
        ]);

        $proyecto = SedeProyectosGrado::findOrFail($request->idProyecto);
        $contador = FaseProyectosfinale::where('pfin_proy', $proyecto->idProyecto)->count();
        if($request->hasFile("docAnteProy")){
            $file1 = $request->file("docAnteProy");
            $file2 = $request->file("docDir");
            $newNameFile1 = $proyecto->codigoproyecto . "PF".$contador."." . $file1->guessExtension();
            $newNameFile2 = $proyecto->codigoproyecto . "PF".$contador."." . $file2->guessExtension();
            $ruta1 = public_path('files/proyFinal/'.$newNameFile1);
            $ruta2 = public_path('files/directorCartaPF/'.$newNameFile2);
            copy($file1, $ruta1);
            copy($file2, $ruta2);

            FaseProyectosfinale::create([
                'documento' => $newNameFile1,
                'cartaDirector' => $newNameFile2,
                'aprobacionDocen' => '-1', //Sin valor definido
                'juradoUno' => $contador < 1 ? FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoUno : $request->juradoUnoInp,
                'juradoDos' => $contador < 1 ? FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderBy('idAnteproyecto', 'desc')->first()->juradoDos : $request->juradoDosInp,
                'estadoJUno' => $request->estadoJUno,
                'estadoJDos' => $request->estadoJDos,
                'estado' => 'Activo',
                'pfin_proy' => $proyecto->idProyecto,

            ]);
        }
        return redirect()->back();
    }



    public function verPdf($nombreArchivo, $ruta)
    { //retorna el pdf
        if($ruta == '1'){
            $rutaArchivo = public_path('files/proyFinal/'.$nombreArchivo);
        }else if($ruta == '2'){
            $rutaArchivo = public_path('files/directorCartaPF/'.$nombreArchivo);
        }


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
        $numJurado = $request-> JIdentificador;
        $this->asignarJurado($idProyecto, $numeroDocumento, 'proFinal', $numJurado);
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
