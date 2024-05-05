<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class valorcalif_subitemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('valorcalif_subitems')->insert([
            'valor' => 'Sí',
        ]);
        DB::table('valorcalif_subitems')->insert([
            'valor' => 'No',
        ]);
        DB::table('valorcalif_subitems')->insert([
            'valor' => 'Parcial',
        ]);
    }
}
