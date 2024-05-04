<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(SedesSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(UsuariosSeeder::class);
        $this->call(FacultadesSeeder::class);
        $this->call(CronogramassSeeder::class);
        $this->call(GruposSeeder::class);
        $this->call(fase_cronogramaSeeder::class);
        $this->call(FechasSeeder::class);
        $this->call(BibliotecasSeeder::class);
        $this->call(ProgramasSeeder::class);
        $this->call(ComitesSeeder::class);
        $this->call(Usuario_programasSeeder::class);
        $this->call(sub_itemsSeeder::class);
        $this->call(itemsSeeder::class);
        $this->call(PonderadosSeeder::class);
        $this->call(ponderado_anteproyectoSeeder::class);

    }
}
