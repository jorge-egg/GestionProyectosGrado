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
        DB::table('sede_programas')->insert([
            'programa' => 'ingerieria informatica',
            'siglas'=>'ING',
            'prog_facu'=>1,
            'prog_sede'=>1,
            
            ]);
            DB::table('sede_programas')->insert([
                'programa' => 'diseño grafico',
                'siglas'=>'DG',
                'prog_facu'=>1,
                'prog_sede'=>1,
                
                ]);
                DB::table('sede_programas')->insert([
                    'programa' => 'contaduria publica',
                    'siglas'=>'CP',
                    'prog_facu'=>1,
                    'prog_sede'=>1,
                    
                    ]);
    }
}
