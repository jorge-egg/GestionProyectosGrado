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
 * @property Collection|SedesFacultade[] $sedes_facultades
 * @property Collection|UsuariosUser[] $usuarios_users
 * @property Collection|SedePrograma[] $sede_programas
 * @property Collection|ProyectoCronograma[] $proyecto_cronogramas
 * @property Collection|SedeBiblioteca[] $sede_bibliotecas
 * @property Collection|ComitesSede[] $comites_sedes
 * @property Collection|SedeProyectosGrado[] $sede_proyectos_grados
 * @property Collection|Consecutivo[] $consecutivos
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

	public function sedes_facultades()
	{
		return $this->hasMany(SedesFacultade::class, 'facu_sede');
	}

	public function usuarios_users()
	{
		return $this->hasMany(UsuariosUser::class, 'usua_sede');
	}

	public function sede_programas()
	{
		return $this->hasMany(SedePrograma::class, 'prog_sede');
	}

	public function proyecto_cronogramas()
	{
		return $this->hasMany(ProyectoCronograma::class, 'cron_sede');
	}

	public function sede_bibliotecas()
	{
		return $this->hasMany(SedeBiblioteca::class, 'bibl_sede');
	}

	public function comites_sedes()
	{
		return $this->hasMany(ComitesSede::class, 'comi_sede');
	}

	public function sede_proyectos_grados()
	{
		return $this->hasMany(SedeProyectosGrado::class, 'proy_sede');
	}

	public function consecutivos()
	{
		return $this->hasMany(Consecutivo::class, 'conc_sede');
	}
}
