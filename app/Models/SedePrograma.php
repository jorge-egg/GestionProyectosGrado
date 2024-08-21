<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SedePrograma
 *
 * @property int $idPrograma
 * @property string $programa
 * @property string $siglas
 * @property int $prog_facu
 * @property string|null $deleted_at
 *
 * @property SedesFacultade $sedes_facultade
 * @property Collection|ComitesSede[] $comites_sedes
 * @property Collection|UsuarioPrograma[] $usuario_programas
 *
 * @package App\Models
 */
class SedePrograma extends Model
{
	// use SoftDeletes;
	protected $table = 'sede_programas';
	protected $primaryKey = 'idPrograma';
	public $timestamps = false;

	protected $casts = [
		'prog_facu' => 'int'
	];

	protected $fillable = [
		'programa',
		'siglas',
        'email',
		'prog_facu'
	];

	public function sedes_facultade()
	{
		return $this->belongsTo(SedesFacultade::class, 'prog_facu');
	}

	public function comites_sedes()
	{
		return $this->hasMany(ComitesSede::class, 'comi_pro');
	}

	public function usuario_programas()
	{
		return $this->hasMany(UsuarioPrograma::class, 'programa');
	}
}
