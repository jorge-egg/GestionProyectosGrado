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
            'nombre' => 'Ingeniería',
            'facu_sede'=>1,
            ]);
    }
}
