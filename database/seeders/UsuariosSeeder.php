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
            'numeroDocumento'=> '100972736',
            'apellido' => 'administrador',
            'email' => 'admin@gmail.com',
            'numeroCelular' => '(602)4021547',
            'usua_sede' => 1,
            'usua_users' => 1,
            ]);
    }
}
