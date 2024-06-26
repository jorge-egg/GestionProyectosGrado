<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Usuario_programasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('usuario_programas')->insert([
            'usuario' => 1007689981,
            'programa' => 1,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689982,
            'programa' => 1,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689983,
            'programa' => 2,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689984,
            'programa' => 2,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689985,
            'programa' => 3,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689986,
            'programa' => 3,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689987,
            'programa' => 4,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689988,
            'programa' => 4,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => 1007689989,
            'programa' => 5,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '123456789',
            'programa' => 1,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '133978936',
            'programa' => 1,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '748392749',
            'programa' => 2,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248110',
            'programa' => 2,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248111',
            'programa' => 3,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248112',
            'programa' => 3,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248113',
            'programa' => 4,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248114',
            'programa' => 4,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248115',
            'programa' => 5,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248116',
            'programa' => 5,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248117',
            'programa' => 1,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248118',
            'programa' => 2,
        ]);
        DB::table('usuario_programas')->insert([
            'usuario' => '1193248119',
            'programa' => 3,
        ]);
    }
}
