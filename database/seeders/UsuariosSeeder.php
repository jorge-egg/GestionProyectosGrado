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
            'nombre' => 'Alexander',
            'numeroDocumento' => '1193248111',
            'apellido' => 'Garzon Galeano',
            'email' => 'alexander@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 5,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Carlos',
            'numeroDocumento' => '1193248112',
            'apellido' => 'Rios Peralta',
            'email' => 'carlos@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 6,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Luis Miguel',
            'numeroDocumento' => '1193248113',
            'apellido' => 'Garzon Galeano',
            'email' => 'luisMiguel@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 7,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Federico',
            'numeroDocumento' => '1193248114',
            'apellido' => 'Segura Durango',
            'email' => 'federico@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 8,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Paulo',
            'numeroDocumento' => '1193248115',
            'apellido' => 'Cardenas Curaca',
            'email' => 'paulo@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 9,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Andrea',
            'numeroDocumento' => '1193248116',
            'apellido' => 'Colosal Torres',
            'email' => 'andrea@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 10,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Laura Cristina',
            'numeroDocumento' => '1193248117',
            'apellido' => 'Garzon Galeano',
            'email' => 'laura0310@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 11,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Vanessa',
            'numeroDocumento' => '1193248118',
            'apellido' => 'Yepes hurtado',
            'email' => 'vanessa@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 12,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Cristian',
            'numeroDocumento' => '1193248119',
            'apellido' => 'Perez Monsalve',
            'email' => 'cristian@gmail.com',
            'numeroCelular' => '(602)3567389',
            'usua_sede' => 1,
            'usua_users' => 13,
            "usua_estado" => 1,
        ]);

        DB::table('usuarios_users')->insert([
            'nombre' => 'Andres Valencia',
            'numeroDocumento' => '1007689981',
            'apellido' => 'Flores Martinez',
            'email' => 'andres@gmail.com',
            'numeroCelular' => '3125636928',
            'usua_sede' => 1,
            'usua_users' => 14,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Cristian',
            'numeroDocumento' => '1007689982',
            'apellido' => 'Mosquera Valencia',
            'email' => 'cristian@gmail.com',
            'numeroCelular' => '3152365478',
            'usua_sede' => 1,
            'usua_users' => 15,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Carlos Enrrique',
            'numeroDocumento' => '1007689983',
            'apellido' => 'Monsalve Castro',
            'email' => 'carlos@gmail.com',
            'numeroCelular' => '3582365588',
            'usua_sede' => 1,
            'usua_users' => 16,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Julian',
            'numeroDocumento' => '1007689984',
            'apellido' => 'Perez Cardona',
            'email' => 'julian@gmail.com',
            'numeroCelular' => '3225327309',
            'usua_sede' => 1,
            'usua_users' => 17,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Felipe',
            'numeroDocumento' => '1007689985',
            'apellido' => 'Hernandez Galeano',
            'email' => 'felipe@gmail.com',
            'numeroCelular' => '3256325411',
            'usua_sede' => 1,
            'usua_users' => 18,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Luis Alberto',
            'numeroDocumento' => '1007689986',
            'apellido' => 'Sanchez Galeano',
            'email' => 'jorgedu0310@gmail.com',
            'numeroCelular' => '3255698741',
            'usua_sede' => 1,
            'usua_users' => 19,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Yerson',
            'numeroDocumento' => '1007689987',
            'apellido' => 'Aguilar Rodriguez',
            'email' => 'yersonaguilarr@gmail.com',
            'numeroCelular' => '3225327309',
            'usua_sede' => 1,
            'usua_users' => 20,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Juan Angel',
            'numeroDocumento' => '1007689988',
            'apellido' => 'Martinez Garzon',
            'email' => 'angel@gmail.com',
            'numeroCelular' => '3225327311',
            'usua_sede' => 1,
            'usua_users' => 21,
            "usua_estado" => 1,
        ]);
        DB::table('usuarios_users')->insert([
            'nombre' => 'Oscar',
            'numeroDocumento' => '1007689989',
            'apellido' => 'Ocampo Garcia',
            'email' => 'oscar@gmail.com',
            'numeroCelular' => '3225327333',
            'usua_sede' => 1,
            'usua_users' => 22,
            "usua_estado" => 1,
        ]);
    }
}
