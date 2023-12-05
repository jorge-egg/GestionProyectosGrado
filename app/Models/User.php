<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string $usuario
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property int $estado
 *
 * @property Collection|UsuariosUser[] $usuarios_users
 *
 * @package App\Models
 */

class User extends Authenticatable
{
    use HasRoles;
    use SoftDeletes;

	protected $table = 'users';

	protected $casts = [
		'email_verified_at' => 'datetime',
		'estado' => 'int'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'usuario',
		'email_verified_at',
		'password',
		'remember_token',
		'estado'
	];

	public function usuarios_users()
	{
		return $this->hasMany(UsuariosUser::class, 'usua_estado');
	}

}
