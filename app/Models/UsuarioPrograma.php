<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UsuarioPrograma
 *
 * @property int $idUsuario_programa
 * @property int $usuario
 * @property int $programa
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property UsuariosUser $usuarios_user
 * @property SedePrograma $sede_programa
 *
 * @package App\Models
 */
class UsuarioPrograma extends Model
{
	protected $table = 'usuario_programas';
	protected $primaryKey = 'idUsuario_programa';

	protected $casts = [
		'usuario' => 'int',
		'programa' => 'int'
	];

	protected $fillable = [
		'usuario',
		'programa',
        'siglas'
	];

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'usuario');
	}

	public function sede_programa()
	{
		return $this->belongsTo(SedePrograma::class, 'programa');
	}
}
