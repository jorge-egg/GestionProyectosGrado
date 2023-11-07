<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoCronograma
 * 
 * @property int $idCronograma
 * @property int $cron_sede
 * 
 * @property Sede $sede
 * @property Collection|CronogramaGrupo[] $cronograma_grupos
 * @property Collection|FasesCronograma[] $fases_cronogramas
 *
 * @package App\Models
 */
class ProyectoCronograma extends Model
{
	protected $table = 'proyecto_cronogramas';
	protected $primaryKey = 'idCronograma';
	public $timestamps = false;

	protected $casts = [
		'cron_sede' => 'int'
	];

	protected $fillable = [
		'cron_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'cron_sede');
	}

	public function cronograma_grupos()
	{
		return $this->hasMany(CronogramaGrupo::class, 'grup_cron');
	}

	public function fases_cronogramas()
	{
		return $this->hasMany(FasesCronograma::class, 'fase_cron');
	}
}
