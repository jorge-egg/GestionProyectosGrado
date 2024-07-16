<?php

namespace App\Traits;

use App\Models\Integrante;
use App\Models\FaseSustentacione;
use App\Models\FaseProyectosfinale;
use App\Models\UsuariosUser;

trait FaseSustentacion
{

public function createSustentacion(){
        $idUsuario = UsuariosUser::where('usua_users', Auth()->id())->orderBy('numeroDocumento', 'desc')->first()->numeroDocumento;
        //dd($idUsuario);
        $idProy = Integrante::where('usuario', $idUsuario)->select('proyecto')->orderBy('proyecto', 'desc')->first()->proyecto;
        //dd($idProy);
        $pFinal = FaseProyectosfinale::where('pfin_proy', $idProy)->orderBy('idProyectofinal', 'desc');
        $estadoPFinal = $pFinal->exists() ? $pFinal->first()->estado : 'Rechazado';
        //dd($estadoPFinal);
        if(!FaseSustentacione::where('sust_proy', $idProy)->exists() && $estadoPFinal == 'Aprobado'){
            dd('entro');
            FaseSustentacione::create([
                'sust_proy' => $idProy,
                'juradoUno' => $pFinal->first()->juradoUno,
                'juradoDos' => $pFinal->first()->juradoDos,
                'estado' => 'Pendiente'
            ]);
        }



    }
}
