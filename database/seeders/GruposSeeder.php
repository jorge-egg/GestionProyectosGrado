<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class GruposSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cronograma_grupos')->insert([
            'estado'=>'activo',
            'grup_cron'=>1,
            ]);
            DB::table('cronograma_grupos')->insert([
                'estado'=>'activo',
                'grup_cron'=>1,
                ]);
                DB::table('cronograma_grupos')->insert([
                    'estado'=>'activo',
                    'grup_cron'=>1,
                    ]);
                    DB::table('cronograma_grupos')->insert([
                        'estado'=>'activo',
                        'grup_cron'=>1,
                        ]);
    }
}
