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
            'sede' => 'Cali',
            'direccion' => 'Carrera 42 #5A - 79',
            'email' => 'recepcion@aunar.edu.co',
            'telefono' => '(602)4021547',
            ]);
            DB::table('sedes')->insert([
                'sede' => 'pasto',
                'direccion' => 'Carrera 42 #5A - 79',
                'email' => 'recepcion@aunar.edu.co',
                'telefono' => '(602)4021547',
                ]);
    }
}
