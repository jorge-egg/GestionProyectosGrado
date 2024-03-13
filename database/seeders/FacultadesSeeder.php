<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FacultadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes_facultades')->insert([
            'nombre' => 'Ciencias económicas',
            'facu_sede' => 1,
        ]);
        DB::table('sedes_facultades')->insert([
            'nombre' => 'Ingeniería',
            'facu_sede' => 1,
        ]);
        DB::table('sedes_facultades')->insert([
            'nombre' => 'artes',
            'facu_sede' => 2,
        ]);
        DB::table('sedes_facultades')->insert([
            'nombre' => 'administrativas',
            'facu_sede' => 2,
        ]);
    }
}
