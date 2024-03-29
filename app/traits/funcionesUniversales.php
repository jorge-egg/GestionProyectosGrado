<?php

namespace App\Traits;

use Exception;
use Carbon\Carbon;
use App\Models\Sede;
use App\Models\FechasGrupo;
use App\Models\UsuariosUser;
use App\Models\ObservacionesCalificacione;

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
            //dd($observacionesAnterior);
            $array = [];
            foreach ($observacionesAnterior as $observacion) {
                $dato = $observacion->observacion;
                array_push($array, $dato);
            }
            if ($observacionesAnterior->empty()) {
                for ($i = 0; $i < $cantObs; $i++) {
                    array_push($array, "");
                }
            }
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
    public function rangoFecha($fase){
        if ($this->ultimaFecha($fase) == null) {
            return $rangoFecha = $array = ["--", "--", false];
        } else {
            return $rangoFecha = $this->ultimaFecha($fase);
        }
    }

}
