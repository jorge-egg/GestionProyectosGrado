<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Integrante
 * 
 * @property int $idIntegrantes
 * @property int $usuario
 * @property int $proyecto
 * 
 * @property UsuariosUser $usuarios_user
 * @property SedeProyectosGrado $sede_proyectos_grado
 *
 * @package App\Models
 */
class Integrante extends Model
{
	protected $table = 'integrantes';
	protected $primaryKey = 'idIntegrantes';
	public $timestamps = false;

	protected $casts = [
		'usuario' => 'int',
		'proyecto' => 'int'
	];

	protected $fillable = [
		'usuario',
		'proyecto'
	];

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'usuario');
	}

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'proyecto');
	}
}
