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
            'sub_items'=> 1,

        ]);
        DB::table('items')->insert([
            'item' => 'Linea de investigación',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Descripción del problema',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Objetivo general',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Objetivos especificos',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Elementos de administración y control',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Introduccion',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Planteamiento del problema',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Justificación',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Marco referencial',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Metodología',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Desarrollo del proyecto',
            'sub_items'=> 1,
        ]);
        DB::table('items')->insert([
            'item' => 'Normas de presentación en el documento y referencias bibliográficas',
            'sub_items'=> 1,
        ]);
    }
}
