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
        $role2 = Role::create(['name' => 'administrador']);

        Permission::create(['name' => 'usuario.crear'])->syncRoles([$superadministrador, $role2]);
        Permission::create(['name' => 'usuario.editar'])->syncRoles([$superadministrador]);
        Permission::create(['name' => 'usuario.eliminar'])->syncRoles([$superadministrador, $role2]);
        Permission::create(['name' => 'usuario.leer'])->syncRoles([$superadministrador, $role2]);
        Permission::create(['name' => 'usuario.bloquear'])->syncRoles([$superadministrador, $role2]);
        Permission::create(['name' => 'usuario.rol'])->syncRoles([$superadministrador, $role2]);
        Permission::create(['name' => 'usuario.permiso'])->syncRoles([$superadministrador]);
    }
}
