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
            'usuario' =>123456789,
            'programa'=>1,
            ]);
            DB::table('usuario_programas')->insert([
                'usuario' =>133978936,
                'programa'=>1,
                ]);
                DB::table('usuario_programas')->insert([
                    'usuario' =>748392749,
                    'programa'=>1,
                    ]);
                    DB::table('usuario_programas')->insert([
                        'usuario' =>1193248110,
                        'programa'=>1,
                        ]);
                    DB::table('usuario_programas')->insert([
                        'usuario' =>1193248110,
                        'programa'=>3,
                        ]);
                        DB::table('usuario_programas')->insert([
                            'usuario' =>1007689987,
                            'programa'=>2,
                            ]);


    }
}
