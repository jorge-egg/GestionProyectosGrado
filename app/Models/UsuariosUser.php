<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UsuariosUser
 * 
 * @property int $numeroDocumento
 * @property string $nombre
 * @property string $apellido
 * @property string $email
 * @property string $numeroCelular
 * @property int $usua_sede
 * @property int $usua_users
 * @property int $usua_estado
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Sede $sede
 * @property User $user
 * @property Collection|SedeProyectosGrado[] $sede_proyectos_grados
 * @property Collection|Integrante[] $integrantes
 * @property Collection|IntegrantesComite[] $integrantes_comites
 * @property Collection|UsuarioPrograma[] $usuario_programas
 *
 * @package App\Models
 */
class UsuariosUser extends Model
{
	use SoftDeletes;
	protected $table = 'usuarios_users';
	protected $primaryKey = 'numeroDocumento';

	protected $casts = [
		'usua_sede' => 'int',
		'usua_users' => 'int',
		'usua_estado' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'numeroCelular',
		'usua_sede',
		'usua_users',
		'usua_estado'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'usua_sede');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usua_estado');
	}

	public function sede_proyectos_grados()
	{
		return $this->hasMany(SedeProyectosGrado::class, 'docente');
	}

	public function integrantes()
	{
		return $this->hasMany(Integrante::class, 'usuario');
	}

	public function integrantes_comites()
	{
		return $this->hasMany(IntegrantesComite::class, 'usuario');
	}

	public function usuario_programas()
	{
		return $this->hasMany(UsuarioPrograma::class, 'usuario');
	}
}
