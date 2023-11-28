<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class fase_cronogramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fases_cronogramas')->insert([
            'fase' => 'Propuesta',
            ]);
            DB::table('fases_cronogramas')->insert([
                'fase' => 'Anteproyecto',
                ]);
                DB::table('fases_cronogramas')->insert([
                    'fase' => 'Proyecto final',
                    ]);
                    DB::table('fases_cronogramas')->insert([
                        'fase' => '	Sustentación',
                        ]);
    }
}
