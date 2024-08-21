<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Sede;
use App\Models\Integrante;
use App\Models\ComitesSede;
use App\Models\Consecutivo;
use App\Models\SedePrograma;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedeBiblioteca;
use App\Mail\invitacionIntegrante;
use App\Models\FaseAnteproyecto;
use App\Models\FasePropuesta;
use App\Models\FaseProyectosfinale;
use App\Models\FaseSustentacione;
use App\Models\SedeProyectosGrado;
use Illuminate\Support\Facades\Mail;
use App\Traits\FaseSustentacion;

class ProyectosController extends Controller
{
    use FaseSustentacion;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            //Consultar si el usuario tiene un proyecto activo para bloquear la opcion de crear otro
            $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first()->numeroDocumento;
            $estado    = Integrante::join('sede_proyectos_grado', 'sede_proyectos_grado.idProyecto', 'integrantes.proyecto')
                ->where('usuario', $usuario)
                ->orderBy('idProyecto', 'desc')
                ->select('sede_proyectos_grado.estado')
                ->first()
                ->estado;
        } catch (Exception $e) {
            $estado = false;
        }


        return view('Layouts.proyecto.index', compact('estado'));
    }


    //index para mostrar al usuario logueado
    public function indextable()
    {
        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $proyectos = Integrante::join('sede_proyectos_grado', 'sede_proyectos_grado.idProyecto', 'integrantes.proyecto')
            ->where('usuario', $usuario->numeroDocumento)
            ->orderBy('idProyecto', 'asc')
            ->get();
        $this->createSustentacion();
        foreach($proyectos as $proyecto){
            $proyecto->estadoFases = $this->validarEstadoFases($proyecto->idProyecto);
        }
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }

    //index para mostrar todos los proyectos de la sede
    public function indextableAll()
    {

        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $sedeId = Sede::where('idSede', $usuario->usua_sede)->first()->idSede;
        $proyectos = SedeProyectosGrado::where('proy_sede', $sedeId)->get();
        foreach($proyectos as $proyecto){
            $proyecto->estadoFases = $this->validarEstadoFases($proyecto->idProyecto);
        }
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }

    //index para mostrar todos los proyectos asiganados por comite
    public function indextableComite()
    {
        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $proyectos = ComitesSede::join('sede_proyectos_grado', 'sede_proyectos_grado.comite', 'comites_sedes.idComite')
        ->join('integrantes_comites', 'integrantes_comites.comite', 'comites_sedes.idComite')
        ->where('usuario', $usuario->numeroDocumento)
        ->get();
        foreach($proyectos as $proyecto){
            $proyecto->estadoFases = $this->validarEstadoFases($proyecto->idProyecto);
        }
        //dd($proyectos);
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }



    //index para mostrar todos los proyectos asiganados por comite
    public function indextableJurado()
    {
        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $proyectos = SedeProyectosGrado::join('fase_anteproyectos', 'fase_anteproyectos.ante_proy', 'sede_proyectos_grado.idProyecto')
        ->where('juradoUno', $usuario->numeroDocumento)
        ->orWhere('juradoDos', $usuario->numeroDocumento)
        ->get();

        if(!isset($proyectos)){
            //dd($proyectos);
            $proyectos = SedeProyectosGrado::join('fase_proyectosfinales', 'fase_proyectosfinales.pfin_proy', 'sede_proyectos_grado.idProyecto')
            ->where('juradoUno', $usuario->numeroDocumento)
            ->orWhere('juradoDos', $usuario->numeroDocumento)
            ->get();
        }

        foreach($proyectos as $proyecto){
            $proyecto->estadoFases = $this->validarEstadoFases($proyecto->idProyecto);
        }

        //dd($proyectos);
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }



    public function indextableDocente() //muestra los royectos a los que el docente ue asignado
    {
        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $proyectos = SedeProyectosGrado::where('docente', $usuario->numeroDocumento)->get();
        foreach($proyectos as $proyecto){
            $proyecto->estadoFases = $this->validarEstadoFases($proyecto->idProyecto);
        }
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $integrantes)
    {

        try {
            $codigoUsuario = $integrantes == '2' ? $request->codUsuario : null; //obtiene elcodigo del segundo integrante
            $anoActual       = Carbon::now()->format('Y');
            $usuario         = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
            $idSede          = $usuario->usua_sede;
            $idBiblioteca    = SedeBiblioteca::where('bibl_sede', $idSede)->orderBy('idBiblioteca', 'desc')->first()->bibl_sede;
            $programa        = SedePrograma::join('usuario_programas', 'usuario_programas.programa', 'sede_programas.idPrograma')
            ->join('comites_sedes', 'comites_sedes.comi_pro', 'sede_programas.idPrograma')
            ->where('usuario', $usuario->numeroDocumento)
                //->select('sede_programas.*')
                ->first();



            $consecutivoData = Sede::join('usuarios_users as usuarios', 'usuarios.usua_sede', 'sedes.idSede')
                ->join('consecutivo', 'consecutivo.conc_sede', 'sedes.idSede')
                ->take(1)
                ->select('consecutivo.*');
            $consecutivo = $this->validarConsecutivo($anoActual, $idSede, $consecutivoData);
            SedeProyectosGrado::create([
                'estado' => true,
                'codigoproyecto' => $programa->siglas . $consecutivo . $anoActual,
                'proy_sede' => $idSede,
                'proy_bibl' => $idBiblioteca,
                'comite' => $programa->comi_pro,
            ]);
            $mailTo = $programa->email;
            $nameMailTo = 'AUNAR '.$programa->siglas;
            $this->createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario, $mailTo, $nameMailTo);
            notify()->success('Proyecto creado exitosamente');
         } catch (Exception $e) {
            echo $e;
            notify()->error('falla: ocurrio un problema al crear su solicitud, por favor intente mas tarde.');
        }
        return redirect()->route('proyecto.index');
    }

    public function validarConsecutivo($anoActual, $idSede, $consecutivoData) //verifica y obtiene el consecutivo segun el año actual
    {

        if (count($consecutivoData->get()) > 0) {
            $tabelConsecutivo = Consecutivo::findOrFail($consecutivoData->first()->IdConsecutivo);

            if ($anoActual > $consecutivoData->first()->ano) {
                $tabelConsecutivo->consecutivo = 0;
                $tabelConsecutivo->ano = $anoActual;
                $tabelConsecutivo->save();
            } else {
                $tabelConsecutivo->consecutivo++;
                $tabelConsecutivo->save();
            }
        } else {

            Consecutivo::create([
                'consecutivo' => 0,
                'ano' => $anoActual,
                'conc_sede' => $idSede,
            ]);
            $tabelConsecutivo = Consecutivo::findOrFail($consecutivoData->first()->IdConsecutivo);
        }


        return $tabelConsecutivo->consecutivo < 10 ? '0' . $tabelConsecutivo->consecutivo : $tabelConsecutivo->consecutivo;
    }


    public function buscarIntegrante(Request $request) //busca el integrante y devuelve el nombre a un modal
    {
        $codigoUsuario = $request->get('documento');

        try {
            $usuarioConsultado = UsuariosUser::where('numeroDocumento', $codigoUsuario)->first();
            $data = $usuarioConsultado->nombre . " " . $usuarioConsultado->apellido;
            $response = ['data' => $data, 'codigoUsuario' => $codigoUsuario];

            return response()->json($response);
        } catch (Exception $e) {
            $data = "Usuario no encontrado";
            $response = ['data' => $data, 'codigoUsuario' => $codigoUsuario];
            return response()->json($response);
        }
    }

    public function createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario, $mailTo, $nameMailTo)
    {

        try {

            $idProyecto = SedeProyectosGrado::where('proy_sede', $idSede)->orderBy('idProyecto', 'desc')->first()->idProyecto;

            Integrante::create([
                'usuario'  => $usuario->numeroDocumento,
                'proyecto' => $idProyecto,
            ]);


            $usuarioDos = UsuariosUser::where('numeroDocumento', $codigoUsuario)->whereNull('deleted_at')->first();
            dd($usuarioDos);
            if ($integrantes == '2') {
                $nombreUsuario = $usuarioDos->nombre . ' ' . $usuarioDos->apellido;
                Mail::to($usuarioDos->email)
                ->send(new invitacionIntegrante($nombreUsuario, $codigoUsuario, $idProyecto, $mailTo, $nameMailTo));
            }
        } catch (Exception $e) {
            echo "error " . $e;
            dd($e);

        }
    }

    public function segundoIntegrante($usuario, $proyecto){
        $codigoUsuario = $usuario;
        $idProyecto = $proyecto;
        Integrante::create([
            'usuario'  => $codigoUsuario,
            'proyecto' => $idProyecto,
        ]);
        return redirect()->route('proyecto.index');
    }

    //obtiene los datos de la sustentacion segun el proyecto
    public function obtSustentacion(Request $request){
        $idProyecto = $request->get('idProyecto');
        $data = $this->consultarSustentacion($idProyecto);
        $dataJuradoUno = UsuariosUser::where('numeroDocumento', $data->juradoUno)->first();
        $juradoUno = $dataJuradoUno->nombre. " " .$dataJuradoUno->apellido;
        $dataJuradoDos = UsuariosUser::where('numeroDocumento', $data->juradoDos)->first();
        $juradoDos = $dataJuradoDos->nombre. " " .$dataJuradoDos->apellido;
        $response = ['data' => $data, 'juradoUno' => $juradoUno, 'juradoDos' => $juradoDos];
        return response()->json($response);
    }

    public function guardarSustaprobado(Request $request){
        //dd($request);
        $request->validate([
            'soporte' => 'required|mimes:pdf|max:3048',
        ]);
        //La letra R representa el rechazado
        $this->guardar($request, 'A');
        return redirect()->route('proyecto.indextableJurado');

    }
    public function guardarSustrechazado(Request $request){
        //dd($request);
        $request->validate([
            'soporte' => 'required|mimes:pdf|max:3048',
        ]);
        //La letra A representa el aprobado
        $this->guardar($request, 'R');
        return redirect()->route('proyecto.indextableJurado');
    }

    public function mostrarPdf($nombreDoc){

        $nombre = $nombreDoc;
        $this->verPdf($nombre);
    }




    public function validarEstadoFases($idProyecto){

        $estados = [];
        $propuesta = FasePropuesta::where('prop_proy', $idProyecto);
        if($propuesta->exists()){
            array_push($estados, $this->asigSegunEstado($propuesta->orderBy('idPropuesta', 'desc')->select('estado')->first()->estado));
            $anteproyecto = FaseAnteproyecto::where('ante_proy', $idProyecto);
            if($anteproyecto->exists()){
                array_push($estados, $this->asigSegunEstado($anteproyecto->orderBy('idAnteproyecto', 'desc')->select('estado')->first()->estado));
                $proyectoFinal = FaseProyectosfinale::where('pfin_proy', $idProyecto);
                if($proyectoFinal->exists()){
                    array_push($estados, $this->asigSegunEstado($proyectoFinal->orderBy('idProyectofinal', 'desc')->select('estado')->first()->estado));
                    $sustentacion = FaseSustentacione::where('sust_proy', $idProyecto);
                    if($sustentacion->exists()){
                        array_push($estados, $this->asigSegunEstado($sustentacion->orderBy('idSustentacion', 'desc')->select('estado')->first()->estado));
                        return $estados;
                    }else{
                        array_push($estados, 5);
                        return $estados;
                    }
                }else{
                    for ($i=0; $i < 2; $i++) {
                        array_push($estados, 5);
                    }
                    return $estados;
                }
            }else{
                for ($i=0; $i < 3; $i++) {
                    array_push($estados, 5);
                }
                return $estados;
            }
        }else{
            for ($i=0; $i < 4; $i++) {
                array_push($estados, 5); //no existe fase
            }
            return $estados;
        }
    }


    //asigan un valor segun el estado
    public function asigSegunEstado($estado){
        //los estados se manejaran asi:
        //pendiente = -1
        //aprobado = 1
        //rechazado = 2
        //aplazado = 3
        //Verificar = 4
        switch ($estado) {
            case 'Aprobado':
                return 1;
                break;
            case 'Aplazado con modificaciones':
                return 3;
                break;
            case 'Rechazado':
                return 2;
                break;
            case 'Pendiente':
                return -1;
                break;
            case 'Verificar':
                return 4;
                break;
            default:
                return -1;
                break;
        }
    }
}







