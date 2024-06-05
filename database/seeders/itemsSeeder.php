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
            'codigoItem' => '001',
            'item' => 'Título',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '002',
            'item' => 'Linea de investigación',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '003',
            'item' => 'Descripción del problema',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '004',
            'item' => 'Objetivo general',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '005',
            'item' => 'Objetivos especificos',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '006',
            'item' => 'Introduccion',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '007',
            'item' => 'Planteamiento del problema',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '008',
            'item' => 'Justificación',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '009',
            'item' => 'Marco referencial',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '010',
            'item' => 'Metodología',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '011',
            'item' => 'Elementos de administración y control',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '012',
            'item' => 'Normas de presentación en el documento y referencias bibliográficas',
        ]);
        DB::table('items')->insert([
            'codigoItem' => '013',
            'item' => 'Desarrollo del proyecto',
        ]);
    }
}
