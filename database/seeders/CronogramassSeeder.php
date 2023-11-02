<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CronogramassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('proyecto_cronogramas')->insert([
            'fases' => 'activo',
            'cron_sede'=> 1,
            ]);
    }
}
