<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SedePrograma
 * 
 * @property int $idPrograma
 * @property string $programa
 * @property string $siglas
 * @property int $prog_facu
 * @property int $prog_sede
 * @property int $prog_usua
 * @property string|null $deleted_at
 * 
 * @property SedesFacultade $sedes_facultade
 * @property Sede $sede
 * @property UsuariosUser $usuarios_user
 *
 * @package App\Models
 */
class SedePrograma extends Model
{
	use SoftDeletes;
	protected $table = 'sede_programas';
	protected $primaryKey = 'idPrograma';
	public $timestamps = false;

	protected $casts = [
		'prog_facu' => 'int',
		'prog_sede' => 'int',
		'prog_usua' => 'int'
	];

	protected $fillable = [
		'programa',
		'siglas',
		'prog_facu',
		'prog_sede',
		'prog_usua'
	];

	public function sedes_facultade()
	{
		return $this->belongsTo(SedesFacultade::class, 'prog_facu');
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'prog_sede');
	}

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'prog_usua');
	}
}
