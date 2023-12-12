<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadministrador = Role::create(['name' => 'superadministrador']);
        $administrador = Role::create(['name' => 'administrador']);
        $estudiante= Role::create(['name' => 'estudiante']);
        $docente = Role::create(['name' => 'docente']);
        $comite = Role::create(['name' => 'comite']);
        $bibliotecario = Role::create(['name' => 'bibliotecario']);


        //usuarios
        Permission::create(['name' => 'usuario.crear'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'usuario.editar'])->syncRoles([$superadministrador]);
        Permission::create(['name' => 'usuario.eliminar'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'usuario.leer'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'usuario.bloquear'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'usuario.rol'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'usuario.permiso'])->syncRoles([$superadministrador]);

        //propuestas
        Permission::create(['name' => 'propuesta.calificar'])->syncRoles([$superadministrador, $administrador, $docente, $comite]);
        Permission::create(['name' => 'propuesta.agregar'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'propuesta.enviarCalificar'])->syncRoles([$superadministrador, $docente, $administrador, $comite]);

        //proyectos view
        Permission::create(['name' => 'proyecto.crear'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'proyecto.consultar'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'proyecto.consultarTodo'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'proyecto.consultarComite'])->syncRoles([$comite]);
        Permission::create(['name' => 'proyecto.ponderados'])->syncRoles([$superadministrador]);
    }
}
