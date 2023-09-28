<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SedesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sedes')->insert([
            'nombreIdentificador' => 'Cali',
            'direccion' => 'Carrera 42 # 5A - 79',
            'email' => 'www.aunarcali.edu.com',
            'telefono' => '(602)4021547',
            ]);
    }
}
