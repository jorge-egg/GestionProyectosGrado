<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            'passEmail' => 'fglnllhkjqbgcdqd',
            'prog_facu'=>1,
            ]);
            DB::table('sede_programas')->insert([
                'programa' => 'Administración de empresas',
                'siglas'=>'AE',
                'email'=>'administracion@gmail.com',
                'passEmail' => 'fglnllhkjqbgcdqd',
                'prog_facu'=>1,
                ]);
                DB::table('sede_programas')->insert([
                    'programa' => 'Tecnología en gestión empresarial',
                    'siglas'=>'TGE',
                    'email'=>'tecnologia@gmail.com',
                    'passEmail' => 'fglnllhkjqbgcdqd',
                    'prog_facu'=>1,
                    ]);
                    DB::table('sede_programas')->insert([
                        'programa' => 'Ingeniería informática',
                        'siglas'=>'ING',
                        'email'=>'jorgedu0310@gmail.com',
                        'passEmail' => 'fglnllhkjqbgcdqd',
                        'prog_facu'=>2,
                        ]);
                        DB::table('sede_programas')->insert([
                            'programa' => 'Tecnología en producción gráfica',
                            'siglas'=>'TPG',
                            'email'=>'tecnologia@gmail.com',
                            'passEmail' => 'fglnllhkjqbgcdqd',
                            'prog_facu'=>2,
                            ]);
                            DB::table('sede_programas')->insert([
                                'programa' => 'Diseño visual',
                                'siglas'=>'DV',
                                'email'=>'diseño@gmail.com',
                                'passEmail' => 'fglnllhkjqbgcdqd',
                                'prog_facu'=>2,
                                ]);

    }
}
