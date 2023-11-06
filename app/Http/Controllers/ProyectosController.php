<?php

namespace App\Http\Controllers;

use notify;
use Exception;
use Carbon\Carbon;
use App\Models\Sede;
use App\Models\Consecutivo;
use App\Models\Integrante;
use App\Models\SedeBiblioteca;
use App\Models\SedePrograma;
use App\Models\UsuariosUser;
use Illuminate\Http\Request;
use App\Models\SedeProyectosGrado;

class ProyectosController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Layouts.proyecto.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $integrantes)
    {
        $codigoUsuario = $integrantes == '2' ? $request->codUsuario : null;
        $anoActual       = Carbon::now()->format('Y');
        $usuario         = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        $idSede          = $usuario->usua_sede;
        $idBiblioteca    = SedeBiblioteca::where('bibl_sede', $idSede)->orderBy('idBiblioteca', 'desc')->first()->bibl_sede;
        $programa        = SedePrograma::all()->where('prog_usua', $usuario->numeroDocumento)->first();
        $consecutivoData = Sede::join('usuarios_users as usuarios', 'usuarios.usua_sede', 'sedes.idSede')
        ->join('consecutivo','consecutivo.conc_sede', 'sedes.idSede')
        ->take(1)
        ->select('consecutivo.*')
        ->first();

        $consecutivo = $this->validarConsecutivo($anoActual, $consecutivoData);

        SedeProyectosGrado::create([
            'estado' => 'En proceso',
            'codigoproyecto' => $programa->siglas.$consecutivo.$anoActual,
            'proy_sede' => $idSede,
		    'proy_bibl' => $idBiblioteca,
        ]);

        $this->createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario);

        return view('Layouts.proyecto.index');
    }

    public function validarConsecutivo($anoActual, $consecutivoData) //verifica y obtiene el consecutivo segun el año actual
    {
        $tabelConsecutivo = Consecutivo::findOrFail($consecutivoData->IdConsecutivo);
        if($anoActual > $consecutivoData->año){
            $tabelConsecutivo->consecutivo = 0;
            $tabelConsecutivo->año = $anoActual;
            $tabelConsecutivo->save();
        }else{
            $tabelConsecutivo->consecutivo++;
            $tabelConsecutivo->save();
        }
        return $tabelConsecutivo->consecutivo < 9 ? '0'.$tabelConsecutivo->consecutivo : $tabelConsecutivo->consecutivo;
    }


    public function buscarIntegrante(Request $request) //busca el integrante y devuelve el nombre a un modal
    {
        $codigoUsuario = $request->get('documento');
        try{
            $usuarioConsultado = UsuariosUser::where('numeroDocumento', $codigoUsuario)->first();
            $data = $usuarioConsultado->nombre . " " . $usuarioConsultado->apellido;
            $response = ['data' => $data, 'codigoUsuario' => $codigoUsuario];
            return response()->json($response);
        } catch (Exception $e){
            $data ="Usuario no encontrado";
            $response = ['data' => $data, 'codigoUsuario' => $codigoUsuario];
            return response()->json($response);
        }

    }

    public function createIntegrante($codigoUsuario, $idSede, $integrantes, $usuario)
    {
        try{
            $idProyecto = SedeProyectosGrado::where('proy_sede', $idSede)->orderBy('idProyecto', 'desc')->first()->idProyecto;

            Integrante::create([
                'usuario'  => $usuario->numeroDocumento,
                'proyecto' => $idProyecto,
            ]);

            if($integrantes == '2')
            {
                Integrante::create([
                    'usuario'  => $codigoUsuario,
                    'proyecto' => $idProyecto,
                ]);
            }

            notify()->success('Proyecto creado exitosamente');
        }catch(Exception $e){
            notify()->error('Error '.$e);
        }
    }
}
