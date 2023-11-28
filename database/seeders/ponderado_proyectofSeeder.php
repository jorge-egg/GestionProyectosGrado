<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ponderado_proyectofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.3,
            'item_pond' => 14,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 15,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 16,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 17,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 1.0,
            'item_pond' => 18,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.8,
            'item_pond' => 19,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 1.3,
            'item_pond' => 20,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 21,
        ]);
    }
}
