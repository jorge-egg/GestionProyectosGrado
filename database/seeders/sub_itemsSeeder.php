<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class sub_itemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_items')->insert([
            'codigo' => '001',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '002',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '003',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '004',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '005',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '006',
            'SubItem' => '',
        ]);
        DB::table('sub_items')->insert([
            'codigo' => '007',
            'SubItem' => '',
        ]);

    }
}
