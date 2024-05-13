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
            'valor' => 'si',
        ]);
        DB::table('valorcalif_subitems')->insert([
            'valor' => 'no',
        ]);
        DB::table('valorcalif_subitems')->insert([
            'valor' => 'parcial',
        ]);
    }
}
