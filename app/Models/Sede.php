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
 * @property string $sede
 * @property string $direccion
 * @property string $email
 * @property string $telefono
 * 
 * @property Collection|UsuariosUser[] $usuarios_users
 * @property Collection|SedesFacultade[] $sedes_facultades
 * @property Collection|SedePrograma[] $sede_programas
 * @property Collection|SedeBiblioteca[] $sede_bibliotecas
 * @property Collection|SedeProyectosGrado[] $sede_proyectos_grados
 * @property Collection|ComitesSede[] $comites_sedes
 * @property Collection|Consecutvo[] $consecutvos
 *
 * @package App\Models
 */
class Sede extends Model
{
	protected $table = 'sedes';
	protected $primaryKey = 'idSede';
	public $timestamps = false;

	protected $fillable = [
		'sede',
		'direccion',
		'email',
		'telefono'
	];

	public function usuarios_users()
	{
		return $this->hasMany(UsuariosUser::class, 'usua_sede');
	}

	public function sedes_facultades()
	{
		return $this->hasMany(SedesFacultade::class, 'facu_sede');
	}

	public function sede_programas()
	{
		return $this->hasMany(SedePrograma::class, 'prog_sede');
	}

	public function sede_bibliotecas()
	{
		return $this->hasMany(SedeBiblioteca::class, 'bibl_sede');
	}

	public function sede_proyectos_grados()
	{
		return $this->hasMany(SedeProyectosGrado::class, 'proy_sede');
	}

	public function comites_sedes()
	{
		return $this->hasMany(ComitesSede::class, 'comi_sede');
	}

	public function consecutvos()
	{
		return $this->hasMany(Consecutvo::class, 'conc_sede');
	}
}
