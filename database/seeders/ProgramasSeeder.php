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
            'prog_facu'=>1,
            'prog_sede'=>1,

            ]);
            DB::table('sede_programas')->insert([
                'programa' => 'Administración de empresas',
                'siglas'=>'AE',
                'prog_facu'=>1,
                'prog_sede'=>1,

                ]);
                DB::table('sede_programas')->insert([
                    'programa' => 'Tecnología en gestión empresarial',
                    'siglas'=>'TGE',
                    'prog_facu'=>1,
                    'prog_sede'=>1,

                    ]);
                    DB::table('sede_programas')->insert([
                        'programa' => 'Ingeniería informática',
                        'siglas'=>'ING',
                        'prog_facu'=>2,
                        'prog_sede'=>1,

                        ]);
                        DB::table('sede_programas')->insert([
                            'programa' => 'Tecnología en producción gráfica',
                            'siglas'=>'TPG',
                            'prog_facu'=>2,
                            'prog_sede'=>1,

                            ]);
                            DB::table('sede_programas')->insert([
                                'programa' => 'Diseño visual',
                                'siglas'=>'DV',
                                'prog_facu'=>2,
                                'prog_sede'=>1,

                                ]);

        //Sede 2
            DB::table('sede_programas')->insert([
                'programa' => 'Administración de empresas',
                'siglas'=>'AE',
                'prog_facu'=>1,
                'prog_sede'=>2,

                ]);
                DB::table('sede_programas')->insert([
                    'programa' => 'Tecnología en gestión empresarial',
                    'siglas'=>'TGE',
                    'prog_facu'=>1,
                    'prog_sede'=>2,

                    ]);
                    DB::table('sede_programas')->insert([
                        'programa' => 'Ingeniería informática',
                        'siglas'=>'ING',
                        'prog_facu'=>1,
                        'prog_sede'=>2,

                        ]);

    }
}
