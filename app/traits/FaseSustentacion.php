<?php

namespace App\Traits;

use App\Models\Integrante;
use App\Models\UsuariosUser;
use App\Models\FaseSustentacione;
use App\Models\SedeProyectosGrado;
use App\Models\FaseProyectosfinale;

trait FaseSustentacion
{

    public function createSustentacion()
    {
        $idUsuario = UsuariosUser::where('usua_users', Auth()->id())->orderBy('numeroDocumento', 'desc')->first()->numeroDocumento;
        //dd($idUsuario);
        $idProy = Integrante::where('usuario', $idUsuario)->select('proyecto')->orderBy('proyecto', 'desc')->first()->proyecto;
        //dd($idProy);
        $pFinal = FaseProyectosfinale::where('pfin_proy', $idProy)->orderBy('idProyectofinal', 'desc');
        $estadoPFinal = $pFinal->exists() ? $pFinal->first()->estado : 'Rechazado';
        //dd($estadoPFinal);
        if (!FaseSustentacione::where('sust_proy', $idProy)->exists() && $estadoPFinal == 'Aprobado') {
            //dd('entro');
            FaseSustentacione::create([
                'sust_proy' => $idProy,
                'juradoUno' => $pFinal->first()->juradoUno,
                'juradoDos' => $pFinal->first()->juradoDos,
                'documento' => '-1',
                'estado' => 'Pendiente'
            ]);
        }
    }



    public function consultarSustentacion($idProyecto){
        $sustentacion = FaseSustentacione::where('sust_proy', $idProyecto)->orderby('idSustentacion', 'desc')->first();
        return $sustentacion;
    }

    //gusrda el archivo de sustentacion
    public function guardar($request, $estado){
        $sustentacion = FaseSustentacione::findOrFail($request->idProyectoSus);
        //dd($sustentacion);
        $proyecto = SedeProyectosGrado::findOrFail($sustentacion->sust_proy);
        if($request->hasFile("soporte")){
            $file1 = $request->file("soporte");
            $newNameFile1 = $proyecto->codigoproyecto . "SUS"."." . $file1->guessExtension();
            $ruta1 = public_path('files/sustentacion/'.$newNameFile1);
            copy($file1, $ruta1);
            $sustentacion->documento = $newNameFile1;
            $sustentacion-> estado = $estado == 'R' ? 'Rechazado' : 'Aprobado';
            $sustentacion->save();

            $proyecto->estado = false;
            $proyecto->save();
        }

    }


    public function verPdf($nombreArchivo)
    { //retorna el pdf
        $rutaArchivo = public_path('files/sustentacion/'.$nombreArchivo);
        // Verificar si el archivo existe
        if (file_exists($rutaArchivo)) {
            // Devolver el archivo para ser mostrado en el navegador
            return response()->file($rutaArchivo);
        } else {
            abort(404, 'Archivo no encontrado');
        }
    }
}
