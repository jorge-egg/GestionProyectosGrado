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
        Permission::create(['name' => 'propuesta.calificar'])->syncRoles([$superadministrador, $administrador, $comite]);
        Permission::create(['name' => 'propuesta.agregar'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'propuesta.enviarCalificar'])->syncRoles([$superadministrador, $docente, $administrador, $comite]);
        Permission::create(['name' => 'fases.acceso'])->syncRoles([$superadministrador, $docente, $administrador, $comite, $estudiante]);


        //anteproyecto
        Permission::create(['name' => 'anteproyecto.calificar'])->syncRoles([$superadministrador, $administrador, $docente]);
        Permission::create(['name' => 'anteproyecto.subirDocumento'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'anteproyecto.aprobarDocumento'])->syncRoles([$superadministrador, $docente, $administrador]);
        Permission::create(['name' => 'anteproyecto.asigDocent'])->syncRoles([$superadministrador, $administrador, $comite]);
        Permission::create(['name' => 'anteproyecto.asigJurados'])->syncRoles([$superadministrador, $administrador, $comite]);
        Permission::create(['name' => 'anteproyecto.verJurados'])->syncRoles([$superadministrador, $administrador, $comite, $docente]);

        //proyectos view
        Permission::create(['name' => 'proyecto.ver'])->syncRoles([$estudiante,$superadministrador, $administrador, $docente, $comite, $bibliotecario]);
        Permission::create(['name' => 'proyecto.crear'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'proyecto.consultar'])->syncRoles([$estudiante]);
        Permission::create(['name' => 'proyecto.consultarTodo'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'proyecto.consultarComite'])->syncRoles([$comite]);
        Permission::create(['name' => 'proyecto.consultarDocente'])->syncRoles([$docente]);
        Permission::create(['name' => 'proyecto.ponderados'])->syncRoles([$superadministrador]);



        //cronograma
        Permission::create(['name' => 'cronograma.ver'])->syncRoles([$superadministrador, $administrador, $estudiante, $docente, $comite, $bibliotecario]);
        Permission::create(['name' => 'cronograma.crear'])->syncRoles([$superadministrador, $administrador]);
        Permission::create(['name' => 'cronograma.editar'])->syncRoles([$superadministrador, $administrador]);



        //comites
        Permission::create(['name' => 'comite.ver'])->syncRoles([$superadministrador, $administrador]);

        //sedes
        Permission::create(['name' => 'sede.ver'])->syncRoles([$superadministrador, $administrador]);


        //sustentacion
        Permission::create(['name' => 'sustentacion.calificar'])->syncRoles([$superadministrador, $administrador, $docente]);

        //reportes
        Permission::create(['name' => 'reportes'])->syncRoles([$superadministrador, $administrador]);
    }
}
