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
 * @property Collection|Usuario[] $usuarios
 * @property Collection|Facultade[] $facultades
 * @property Collection|Programa[] $programas
 * @property Collection|Biblioteca[] $bibliotecas
 * @property Collection|ProyectoGrado[] $proyecto_grados
 * @property Collection|Comite[] $comites
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

	public function usuarios()
	{
		return $this->hasMany(Usuario::class, 'usua_sede');
	}

	public function facultades()
	{
		return $this->hasMany(Facultade::class, 'facu_sede');
	}

	public function programas()
	{
		return $this->hasMany(Programa::class, 'prog_sede');
	}

	public function bibliotecas()
	{
		return $this->hasMany(Biblioteca::class, 'bibl_sede');
	}

	public function proyecto_grados()
	{
		return $this->hasMany(ProyectoGrado::class, 'proy_sede');
	}

	public function comites()
	{
		return $this->hasMany(Comite::class, 'comi_sede');
	}
}
