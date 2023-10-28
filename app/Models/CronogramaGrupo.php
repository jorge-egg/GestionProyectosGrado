<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CronogramaGrupo
 * 
 * @property int $idGrupo
 * @property string $numerogrupo
 * @property string $estado
 * @property int $cron_fech
 * 
 * @property ProyectoCronograma $proyecto_cronograma
 * @property Collection|FechasGrupo[] $fechas_grupos
 *
 * @package App\Models
 */
class CronogramaGrupo extends Model
{
	protected $table = 'cronograma_grupos';
	protected $primaryKey = 'idGrupo';
	public $timestamps = false;

	protected $casts = [
		'cron_fech' => 'int'
	];

	protected $fillable = [
		'numerogrupo',
		'estado',
		'cron_fech'
	];

	public function proyecto_cronograma()
	{
		return $this->belongsTo(ProyectoCronograma::class, 'cron_fech');
	}

	public function fechas_grupos()
	{
		return $this->hasMany(FechasGrupo::class, 'fech_grup');
	}
}
