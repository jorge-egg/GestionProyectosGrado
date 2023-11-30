<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('usuarios_users')->insert([
            'nombre' => 'admin',
            'numeroDocumento' => '123456789',
            'apellido' => 'administrador',
            'email' => 'admin@gmail.com',
            'numeroCelular' => '(602)4021547',
            'usua_sede' => 1,
            'usua_users' => 1,
            "usua_estado" => 1,

        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'julio',
            'numeroDocumento' => '133978936',
            'apellido' => 'Rodrigo',
            'email' => 'julio@gmail.com',
            'numeroCelular' => '(602)3554656',
            'usua_sede' => 1,
            'usua_users' => 2,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Mariana',
            'numeroDocumento' => '748392749',
            'apellido' => 'Marulanda',
            'email' => 'Mariana@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 3,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Jorge Eduardo',
            'numeroDocumento' => '1193248110',
            'apellido' => 'Garzon Galeano',
            'email' => 'Jorgedu0310@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 4,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Yerson',
            'numeroDocumento' => '1007689987',
            'apellido' => 'Aguilar Rodriguez',
            'email' => 'yersonaguilarr@gmail.com',
            'numeroCelular' => '3225327309',
            'usua_sede' => 1,
            'usua_users' => 5,
            "usua_estado" => 1,
        ]);
    }
}
