<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proyecto_fases')->insert([
            'estado' => 'activo',
            'fase_proy' =>1,
            'fase_cron'=>1,
            ]);
    }
}
