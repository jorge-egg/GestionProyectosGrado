<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'usuario' => '123456789',
            'password' => Hash::make('123456'),
        ])->assignRole('superadministrador');
        User::create([
            'usuario' => '133978936',
            'password' => Hash::make('123456'),
        ])->assignRole('administrador');
        User::create([
            'usuario' => '748392749',
            'password' => Hash::make('123456'),
        ])->assignRole('comite');
        User::create([
            'usuario' => '1193248110',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1007689987',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
    }
}
