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
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }

    //index para mostrar todos los proyectos de la sede
    public function indextableAll()
    {

        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $sedeId = Sede::where('idSede', $usuario->usua_sede)->first()->idSede;
        $proyectos = SedeProyectosGrado::where('proy_sede', $sedeId)->get();
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
            dd($proyectos);
            $proyectos = SedeProyectosGrado::join('fase_proyectosfinales', 'fase_proyectosfinales.pfin_proy', 'sede_proyectos_grado.idProyecto')
            ->where('juradoUno', $usuario->numeroDocumento)
            ->orWhere('juradoDos', $usuario->numeroDocumento)
            ->get();
        }

        //dd($proyectos);
        return view('Layouts.proyecto.tableindex', compact('proyectos'));
    }



    public function indextableDocente() //muestra los royectos a los que el docente ue asignado
    {
        $usuario   = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $proyectos = SedeProyectosGrado::where('docente', $usuario->numeroDocumento)->get();
        
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

            $this->createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario);
            notify()->success('Proyecto creado exitosamente');
         } catch (Exception $e) {
            echo $e;
            notify()->error('falla: ' . $e);
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

    public function createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario)
    {
        try {
            $idProyecto = SedeProyectosGrado::where('proy_sede', $idSede)->orderBy('idProyecto', 'desc')->first()->idProyecto;

            Integrante::create([
                'usuario'  => $usuario->numeroDocumento,
                'proyecto' => $idProyecto,
            ]);

            if ($integrantes == '2') {
                $nombreUsuario = $usuario->nombre . ' ' . $usuario->apellido;
                Mail::to($usuario->email)
                ->send(new invitacionIntegrante($nombreUsuario, $codigoUsuario, $idProyecto));
            }
        } catch (Exception $e) {
            echo "error " . $e;
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
}
