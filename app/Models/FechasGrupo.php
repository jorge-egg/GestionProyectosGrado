<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FechasGrupo
 * 
 * @property int $idFecha
 * @property Carbon $fecha_apertura
 * @property Carbon $fecha_cierre
 * @property int $fech_grup
 * @property int $fech_fase
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CronogramaGrupo $cronograma_grupo
 * @property FasesCronograma $fases_cronograma
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
		'fech_grup' => 'int',
		'fech_fase' => 'int'
	];

	protected $fillable = [
		'fecha_apertura',
		'fecha_cierre',
		'fech_grup',
		'fech_fase'
	];

	public function cronograma_grupo()
	{
		return $this->belongsTo(CronogramaGrupo::class, 'fech_grup');
	}

	public function fases_cronograma()
	{
		return $this->belongsTo(FasesCronograma::class, 'fech_fase');
	}
}
