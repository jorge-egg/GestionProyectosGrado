<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Integrante
 *
 * @property int $idIntegrantes
 * @property string $integrante1
 * @property string $integrante2
 * @property string $integrante3
 * @property int $int_usua
 * @property int $int_proy
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
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
		'int_proy' => 'int'
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
