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
            'item_pond' => 6,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 7,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 8,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 9,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 1.0,
            'item_pond' => 10,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.8,
            'item_pond' => 11,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 1.3,
            'item_pond' => 12,
        ]);
        DB::table('ponderados_calificaciones')->insert([
            'ponderado' => 0.4,
            'item_pond' => 13,
        ]);
    }
}
