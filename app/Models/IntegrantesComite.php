<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class IntegrantesComite
 * 
 * @property int $idIntegrantesComite
 * @property int $usuario
 * @property int $comite
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property UsuariosUser $usuarios_user
 * @property ComitesSede $comites_sede
 *
 * @package App\Models
 */
class IntegrantesComite extends Model
{
	protected $table = 'integrantes_comites';
	protected $primaryKey = 'idIntegrantesComite';

	protected $casts = [
		'usuario' => 'int',
		'comite' => 'int'
	];

	protected $fillable = [
		'usuario',
		'comite'
	];

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'usuario');
	}

	public function comites_sede()
	{
		return $this->belongsTo(ComitesSede::class, 'comite');
	}
}
