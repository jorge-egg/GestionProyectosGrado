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
            'item'=>'Titulo',
            ]);
            DB::table('items')->insert([
                'item'=>'linea de investigacion',
                ]);
                DB::table('items')->insert([
                    'item'=>'descripcion del problema',
                    ]);
                    DB::table('items')->insert([
                        'item'=>'Objetivo general',
                        ]);
                        DB::table('items')->insert([
                            'item'=>'Objetivos especificos',
                            ]);
    }
}
