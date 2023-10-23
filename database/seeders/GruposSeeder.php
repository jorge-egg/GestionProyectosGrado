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
            'numerogrupo' => 'Grupo 1',
            'estado'=>'activo',
            'cron_fech'=>1,
            
            ]);
            DB::table('cronograma_grupos')->insert([
                'numerogrupo' => 'Grupo 2',
                'estado'=>'activo',
                'cron_fech'=>1,
                'cron_fech'=>1,
                ]);
                DB::table('cronograma_grupos')->insert([
                    'numerogrupo' => 'Grupo 3',
                    'estado'=>'activo',
                    'cron_fech'=>1,
                    'cron_fech'=>1,
                    ]);
                    DB::table('cronograma_grupos')->insert([
                        'numerogrupo' => 'Grupo 4',
                        'estado'=>'activo',
                        'cron_fech'=>1,
                        'cron_fech'=>1,
                        ]);
    }
}
