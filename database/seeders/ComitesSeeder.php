<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ComitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comites_sedes')->insert([
            'comi_pro' => 1,
        ]);
        DB::table('comites_sedes')->insert([
            'comi_pro' => 2,
        ]);
        DB::table('comites_sedes')->insert([
            'comi_pro' => 3,
        ]);
        DB::table('comites_sedes')->insert([
            'comi_pro' => 4,
        ]);
        DB::table('comites_sedes')->insert([
            'comi_pro' => 5,
        ]);
        DB::table('comites_sedes')->insert([
            'comi_pro' => 6,
        ]);
    }
}
