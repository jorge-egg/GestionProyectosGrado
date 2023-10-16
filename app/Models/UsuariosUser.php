<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

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
 * 
 * @property Sede $sede
 * @property User $user
 * @property Collection|SedePrograma[] $sede_programas
 *
 * @package App\Models
 */
class UsuariosUser extends Model
{
	use SoftDeletes;
	protected $table = 'usuarios_users';
	protected $primaryKey = 'numeroDocumento';
	public $timestamps = false;

	protected $casts = [
		'usua_sede' => 'int',
		'usua_users' => 'int'
	];

	protected $fillable = [
		'nombre',
		'apellido',
		'email',
		'numeroCelular',
		'usua_sede',
		'usua_users',
		'estado'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'usua_sede');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'usua_users');
	}

	public function sede_programas()
	{
		return $this->hasMany(SedePrograma::class, 'prog_usua');
	}
}
