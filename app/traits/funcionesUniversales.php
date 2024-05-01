<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;
use App\Models\Sede;
use App\Models\User;
use App\Models\ComitesSede;
use App\Models\FechasGrupo;
use App\Models\UsuariosUser;
use App\Models\UsuarioPrograma;
use App\Models\FaseAnteproyecto;
use App\Models\IntegrantesComite;
use App\Models\SedeProyectosGrado;
use App\Models\ObservacionesCalificacione;
use Symfony\Component\HttpFoundation\Request;

trait funcionesUniversales
{
    //consultar si existen observaciones creadas por el usuario y tomar la ultima
    public function ultimaObservacion($idFase, $fase, $cantObs)
    {
        try {
            $observacionesAnterior = ObservacionesCalificacione::join('fase_cal_obs', 'fase_cal_obs.observacion_fase', 'observaciones_calificaciones.idObservacion')
                ->where($fase, $idFase)
                ->orderBy('idObservacion', 'asc')
                ->get();
            $array = [];

            if ($fase == 'anteproyecto') {
                $array1 = [];
                $array2 = [];
                foreach ($observacionesAnterior as $observacion) {
                    if ($observacion->numeroJurado == '1') {
                        $dato1 = $observacion->observacion;
                        array_push($array1, $dato1);

                    } else if ($observacion->numeroJurado == '2') {
                        $dato2 = $observacion->observacion;
                        array_push($array2, $dato2);
                    }
                }
                array_push($array, $array1);
                array_push($array, $array2);
            } else {
                foreach ($observacionesAnterior as $observacion) {
                    $dato = [$observacion->observacion];
                    array_push($array, $dato);
                }
            }



            //dd($array);
            if (!isset($observacionesAnterior[0])) {
                for ($i = 0; $i < $cantObs; $i++) {
                    array_push($array, "");
                }
            }
            //dd($array);
        } catch (Exception $e) {
            $array = [];
            for ($i = 0; $i < $cantObs; $i++) {
                array_push($array, "");
            }
        }
        return $array;
    }


    //consultar la ultima fecha de propuestas mas cercana a la actual
    public function ultimaFecha($fase)
    {
        $userId = auth()->id();
        $usuario = UsuariosUser::where('usua_users', $userId)->whereNull('deleted_at')->first();
        $sede = Sede::findOrFail($usuario->usua_sede);
        $habilitado = false;
        $grupos = Sede::join('proyecto_cronogramas', 'proyecto_cronogramas.cron_sede', 'sedes.idSede')
            ->join('cronograma_grupos', 'cronograma_grupos.grup_cron', 'proyecto_cronogramas.idCronograma')
            ->where('sedes.idSede', $sede->idSede)
            ->orderBy('cronograma_grupos.idGrupo', 'asc')
            ->take(4)
            ->select('cronograma_grupos.*')
            ->where('estado', 'activo')
            ->get();

        $array = [];
        $currentDate = Carbon::now()->format('Y-m-d'); // Fecha actual

        $faseNumero = $fase == 'propuesta' ? 1 : ($fase == 'anteproyecto' ? 2 : ($fase == 'proyectoFinal' ? 3 : ($fase == 'sustentacion' ? 4 : null)));

        foreach ($grupos as $grupo) {
            $fechasGrupo = FechasGrupo::where('fech_grup', $grupo->idGrupo)->where('fech_fase', $faseNumero)->get(); //se selecciona la fecha segun su fase

            $fechaApertura = $fechasGrupo->pluck('fecha_apertura');
            $fechaCierre = $fechasGrupo->pluck('fecha_cierre');

            for ($i = 0; $i < count($fechaApertura); $i++) {
                $fechaInicio = Carbon::parse($fechaApertura[$i])->format('Y-m-d');
                $fechaFin = Carbon::parse($fechaCierre[$i])->format('Y-m-d');
                // Verificar si la fecha actual está dentro del rango de apertura y cierre
                if ($fechaInicio <= $currentDate && $fechaFin >= $currentDate) {
                    // La fecha actual está dentro del rango
                    $habilitado = true;
                    array_push($array, $fechaInicio, $fechaFin, $habilitado);
                    return $array;
                    break;
                } elseif ($fechaInicio > $currentDate) {
                    // Si no estamos en el rango actual, tomar la próxima fecha de apertura
                    $habilitado = false;
                    array_push($array, $fechaInicio, $fechaFin, $habilitado);
                    return $array;
                    break;
                }
            }
        }
    }

    //establece el valor de las fechas segun lo obtenido en la funcion ultimaFecha
    public function rangoFecha($fase)
    {
        if ($this->ultimaFecha($fase) == null) {
            return $rangoFecha = $array = ["--", "--", false];
        } else {
            return $rangoFecha = $this->ultimaFecha($fase);
        }
    }


    //Buscar todos los docentes registrados
    public function obtenerDocentes($idProyecto)
    {
        $docentes       = $this->docentes();
        $proyecto       = SedeProyectosGrado::findOrFail($idProyecto);
        $valExistDocent = ($proyecto->docente) == null ? false : true; //valida si ya se asigno un docente al proyecto
        $docente        = $valExistDocent ? UsuariosUser::findOrFail($proyecto->docente) : null;
        $docenteAsig    = $valExistDocent ? $docente->nombre . " " . $docente->apellido : null;

        return $array = array( //array que transportara todos los datos a la view
            'idProyecto' => $idProyecto,
            'valExistDocent' => $valExistDocent,
            'docenteAsig' => $docenteAsig,
            'docentes' => $docentes
        );
    }

    public function docentes()
    { //busca a todos los usuarios con rol de docente
        $array = [];
        //$usuario     = UsuariosUser::where('usua_users',  Auth()->id())->whereNull('deleted_at')->first();
        //$filtroRole  = ModelHasRole::join('roles', 'roles.id', 'model_has_roles.role_id')->where('name', 'docente')->get();
        $usuarios = User::all();
        foreach ($usuarios as $usuario) {
            $docentesRole    = $usuario->roles()->get();

            foreach ($docentesRole as $rol) { //este foreach se realiza debido a que un usuario puede tener varios roles
                if ($rol->name == 'docente') {
                    //$usuarioUser = UsuariosUser::join('sedes', 'sedes.idSede', 'usuarios_users.usua_sede')->where('usua_users', $usuario->id)->whereNull('deleted_at')->first();

                    $usuarioUser = UsuarioPrograma::join('sede_programas', 'usuario_programas.programa', 'sede_programas.idPrograma')
                        ->join('usuarios_users as us', 'usuario_programas.usuario', 'us.numeroDocumento')
                        ->join('sedes', 'us.usua_sede', 'sedes.idSede')
                        ->where('usuario', $usuario->usuario)
                        ->whereNull('us.deleted_at')
                        ->select('numeroDocumento', 'nombre', 'apellido', 'sede', 'usuario_programas.programa', 'usua_users')
                        ->first();

                    array_push($array, $usuarioUser);
                }
            }
        }

        return $array;
    }

    public function obtMiembrosComite($idProyecto)
    {
        return  ComitesSede::join('integrantes_comites', 'integrantes_comites.comite', 'comites_sedes.idComite')
            ->join('usuarios_users', 'usuarios_users.numeroDocumento', 'integrantes_comites.usuario')
            ->where('idComite', (SedeProyectosGrado::findOrFail($idProyecto)->comite))
            ->select('numeroDocumento', 'nombre', 'apellido')
            ->get();
    }

    public function asignarJurado($idProyecto, $numeroDocumento)
    {
        $proyecto = SedeProyectosGrado::findOrFail($idProyecto);
        $anteproyecto = FaseAnteproyecto::where('ante_proy', $proyecto->idProyecto)->orderByDesc('idAnteproyecto')->first();
        if ($anteproyecto->juradoUno != '-1') {
            $anteproyecto->juradoDos = $numeroDocumento; //estado de aprobado
            $anteproyecto->save();
        } else {
            $anteproyecto->juradoUno = $numeroDocumento; //estado de aprobado
            $anteproyecto->save();
        }
    }
}
