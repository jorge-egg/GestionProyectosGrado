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
 * @property string $fecha_apertura
 * @property string $fecha_cierre
 * @property int $fech_grup
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property CronogramaGrupo $cronograma_grupo
 *
 * @package App\Models
 */
class FechasGrupo extends Model
{
	protected $table = 'fechas_grupos';
	protected $primaryKey = 'idFecha';

	protected $casts = [
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
}
