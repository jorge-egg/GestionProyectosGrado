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
            'nombre' => 'Ciencias económicas y administrativas',
            'facu_sede'=>1,
            ]);
            DB::table('sedes_facultades')->insert([
                'nombre' => 'Ingeniería y artes',
                'facu_sede'=>1,
                ]);
    }
}
