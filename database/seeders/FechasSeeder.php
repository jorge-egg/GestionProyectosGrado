<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FechasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


public function run()
{
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2024-04-20',
        'fecha_cierre' => '2024-04-30',
        'fech_grup' => 1,
        'fech_fase' => 1,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2024-04-20',
        'fecha_cierre' => '2024-04-30',
        'fech_grup' => 1,
        'fech_fase' => 2,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2024-05-03',
        'fecha_cierre' => '2024-05-30',
        'fech_grup' => 1,
        'fech_fase' => 3,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2024-05-11',
        'fecha_cierre' => '2024-05-30',
        'fech_grup' => 1,
        'fech_fase' => 4,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 2,
        'fech_fase' => 1,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 2,
        'fech_fase' => 2,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 2,
        'fech_fase' => 3,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 2,
        'fech_fase' => 4,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 3,
        'fech_fase' => 1,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 3,
        'fech_fase' => 2,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 3,
        'fech_fase' => 3,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-15',
        'fech_grup' => 3,
        'fech_fase' => 4,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-01',
        'fech_grup' => 4,
        'fech_fase' => 1,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-02',
        'fech_grup' => 4,
        'fech_fase' => 2,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-03',
        'fech_grup' => 4,
        'fech_fase' => 3,
    ]);
    DB::table('fechas_grupos')->insert([
        'fecha_apertura' => '2023-09-11',
        'fecha_cierre' => '2023-09-04',
        'fech_grup' => 4,
        'fech_fase' => 4,
    ]);

}

}
