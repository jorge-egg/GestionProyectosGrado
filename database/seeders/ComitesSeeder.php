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
        'nombre' => 'comite',
        'comi_sede' => 1,
    ]);
    }
}
