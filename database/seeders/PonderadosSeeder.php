<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PonderadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ponderados_calificaciones')->insert([
            'ponderado'=>0.25,
            'item_pond'=>1,
            ]);
            DB::table('ponderados_calificaciones')->insert([
                'ponderado'=>1.19,
                'item_pond'=>2,
                ]);
                DB::table('ponderados_calificaciones')->insert([
                    'ponderado'=>0.53,
                    'item_pond'=>3,
                    ]);
                    DB::table('ponderados_calificaciones')->insert([
                        'ponderado'=>0.68,
                        'item_pond'=>4,
                        ]);
                        DB::table('ponderados_calificaciones')->insert([
                            'ponderado'=>0.85,
                            'item_pond'=>5,
                            ]);
    }
}
