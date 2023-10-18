<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CronogramasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fechas_grupos')->insert([
            'fecha' => '01/06/2023',
            'fech_grup'=>1,
            ]);
        DB::table('fechas_grupos')->insert([
            'fecha' => '01/06/2023',
            'fech_grup'=>1,
            ]);
                DB::table('fechas_grupos')->insert([
                    'fecha' => '01/06/2023',
                    'fech_grup'=>3,
                    ]);
                    DB::table('fechas_grupos')->insert([
                        'fecha' => '01/06/2023',
                        'fech_grup'=>4,
                        ]);
    }
}
