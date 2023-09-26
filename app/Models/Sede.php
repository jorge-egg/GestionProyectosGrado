<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sede
 * 
 * @property int $idSede
 * @property string $nombreIdentificador
 * @property string $direccion
 * @property string $email
 * @property string $telefono
 * 
 * @property Collection|UsuariosUser[] $usuarios_users
 * @property Collection|FacultadesSede[] $facultades_sedes
 * @property Collection|ProgramasSede[] $programas_sedes
 * @property Collection|BibliotecasSede[] $bibliotecas_sedes
 * @property Collection|ProyectoGradosSede[] $proyecto_grados_sedes
 * @property Collection|ComitesSede[] $comites_sedes
 *
 * @package App\Models
 */
class Sede extends Model
{
	protected $table = 'sedes';
	protected $primaryKey = 'idSede';
	public $timestamps = false;

	protected $fillable = [
		'nombreIdentificador',
		'direccion',
		'email',
		'telefono'
	];

	public function usuarios_users()
	{
		return $this->hasMany(UsuariosUser::class, 'usua_sede');
	}

	public function facultades_sedes()
	{
		return $this->hasMany(FacultadesSede::class, 'facu_sede');
	}

	public function programas_sedes()
	{
		return $this->hasMany(ProgramasSede::class, 'prog_sede');
	}

	public function bibliotecas_sedes()
	{
		return $this->hasMany(BibliotecasSede::class, 'bibl_sede');
	}

	public function proyecto_grados_sedes()
	{
		return $this->hasMany(ProyectoGradosSede::class, 'proy_sede');
	}

	public function comites_sedes()
	{
		return $this->hasMany(ComitesSede::class, 'comi_sede');
	}
}
