<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @property int $idUsers
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|UsuariosUser[] $usuarios_users
 *
 * @package App\Models
 */
class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasRoles;

	protected $table = 'users';
	protected $primaryKey = 'id';

	protected $casts = [
		'email_verified_at' => 'datetime'
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
		return $this->belongsTo(UsuariosUser::class, 'usua_users');
	}
}
