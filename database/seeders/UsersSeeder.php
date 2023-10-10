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
            'usuario' => 'admin',
            'password' => Hash::make('123456'),
            ])->assignRole('superadministrador');
            User::create([
                'usuario' => 'julio',
                'password' => Hash::make('123456'),
                ])->assignRole('superadministrador');
                User::create([
                    'usuario' => 'mariana',
                    'password' => Hash::make('123456'),
                    ])->assignRole('superadministrador');
    }
}
