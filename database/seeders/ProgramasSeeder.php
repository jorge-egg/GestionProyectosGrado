<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sede 1
        DB::table('sede_programas')->insert([
            'programa' => 'Contaduría',
            'siglas'=>'CP',
            'email'=>'contaduria@gmail.com',
            'prog_facu'=>1,
            ]);
            DB::table('sede_programas')->insert([
                'programa' => 'Administración de empresas',
                'siglas'=>'AE',
                'email'=>'administracion@gmail.com',
                'prog_facu'=>1,
                ]);
                DB::table('sede_programas')->insert([
                    'programa' => 'Tecnología en gestión empresarial',
                    'siglas'=>'TGE',
                    'email'=>'tecnologia@gmail.com',
                    'prog_facu'=>1,
                    ]);
                    DB::table('sede_programas')->insert([
                        'programa' => 'Ingeniería informática',
                        'siglas'=>'ING',
                        'email'=>'ingenieria@gmail.com',
                        'prog_facu'=>2,
                        ]);
                        DB::table('sede_programas')->insert([
                            'programa' => 'Tecnología en producción gráfica',
                            'siglas'=>'TPG',
                            'email'=>'tecnologia@gmail.com',
                            'prog_facu'=>2,
                            ]);
                            DB::table('sede_programas')->insert([
                                'programa' => 'Diseño visual',
                                'siglas'=>'DV',
                                'email'=>'diseño@gmail.com',
                                'prog_facu'=>2,
                                ]);

    }
}
