<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FechasGrupo
 * 
 * @property int $idFecha
 * @property Carbon $fecha_apertura
 * @property Carbon $fecha_cierre
 * @property int $fech_grup
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CronogramaGrupo $cronograma_grupo
 * @property Collection|FasesCronograma[] $fases_cronogramas
 *
 * @package App\Models
 */
class FechasGrupo extends Model
{
	protected $table = 'fechas_grupos';
	protected $primaryKey = 'idFecha';

	protected $casts = [
		'fecha_apertura' => 'datetime',
		'fecha_cierre' => 'datetime',
		'fech_grup' => 'int'
	];

	protected $fillable = [
		'fecha_apertura',
		'fecha_cierre',
		'fech_grup'
	];

	public function cronograma_grupo()
	{
		return $this->belongsTo(CronogramaGrupo::class, 'fech_grup');
	}

	public function fases_cronogramas()
	{
		return $this->hasMany(FasesCronograma::class, 'fase_fech');
	}
}
