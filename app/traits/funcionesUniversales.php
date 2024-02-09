<?php

namespace App\Traits;

use App\Models\ObservacionesCalificacione;
use Exception;

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


}
