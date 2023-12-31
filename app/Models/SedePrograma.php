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
 * @property int $prog_sede
 * @property string|null $deleted_at
 * 
 * @property SedesFacultade $sedes_facultade
 * @property Sede $sede
 * @property Collection|UsuarioPrograma[] $usuario_programas
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
		'prog_sede' => 'int'
	];

	protected $fillable = [
		'programa',
		'siglas',
		'prog_facu',
		'prog_sede'
	];

	public function sedes_facultade()
	{
		return $this->belongsTo(SedesFacultade::class, 'prog_facu');
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'prog_sede');
	}

	public function usuario_programas()
	{
		return $this->hasMany(UsuarioPrograma::class, 'programa');
	}
}
