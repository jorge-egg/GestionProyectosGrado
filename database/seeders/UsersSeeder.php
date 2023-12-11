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
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248110',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248111',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248112',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248113',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248114',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248115',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248116',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248117',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248118',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1193248119',
            'password' => Hash::make('123456'),
        ])->assignRole('docente');
        User::create([
            'usuario' => '1007689981',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689982',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689983',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689984',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689985',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689986',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689987',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689988',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
        User::create([
            'usuario' => '1007689989',
            'password' => Hash::make('123456'),
        ])->assignRole('estudiante');
    }
}
