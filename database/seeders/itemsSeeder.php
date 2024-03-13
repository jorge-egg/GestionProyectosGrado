<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class itemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('items')->insert([
            'item' => 'Título',
        ]);
        DB::table('items')->insert([
            'item' => 'Linea de investigación',
        ]);
        DB::table('items')->insert([
            'item' => 'Descripción del problema',
        ]);
        DB::table('items')->insert([
            'item' => 'Objetivo general',
        ]);
        DB::table('items')->insert([
            'item' => 'Objetivos especificos',
        ]);
        DB::table('items')->insert([
            'item' => 'Elementos de administración y control',
        ]);
        DB::table('items')->insert([
            'item' => 'Introduccion',
        ]);
        DB::table('items')->insert([
            'item' => 'Planteamiento del problema',
        ]);
        DB::table('items')->insert([
            'item' => 'Justificación',
        ]);
        DB::table('items')->insert([
            'item' => 'Marco referencial',
        ]);
        DB::table('items')->insert([
            'item' => 'Metodología',
        ]);
        DB::table('items')->insert([
            'item' => 'Desarrollo del proyecto',
        ]);
        DB::table('items')->insert([
            'item' => 'Normas de presentación en el documento y referencias bibliográficas',
        ]);
    }
}
