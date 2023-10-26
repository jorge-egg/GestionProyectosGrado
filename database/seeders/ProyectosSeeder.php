<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sede_proyectos_grado')->insert([
            'estado' => 'activo',
            'codigoproyecto' =>'27462',
            'integrante1'=> 'julian',
            'integrante2'=> 'maria',
            'proy_sede'=>1,
            'proy_bibl'=>1,
            ]);
    }
}
