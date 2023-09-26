<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

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
class User extends Model
{
	protected $table = 'users';
	protected $primaryKey = 'idUsers';

	protected $casts = [
		'email_verified_at' => 'datetime'
	];

	protected $hidden = [
		'password',
		'remember_token'
	];

	protected $fillable = [
		'email_verified_at',
		'password',
		'remember_token'
	];

	public function usuarios_users()
	{
		return $this->hasMany(UsuariosUser::class, 'usua_users');
	}
}
