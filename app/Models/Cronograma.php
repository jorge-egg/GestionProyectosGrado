<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cronograma
 * 
 * @property int $idCronograma
 * @property string $fases
 * 
 * @property Collection|FasesProyecto[] $fases_proyectos
 * @property Collection|GruposCronograma[] $grupos_cronogramas
 *
 * @package App\Models
 */
class Cronograma extends Model
{
	protected $table = 'cronogramas';
	protected $primaryKey = 'idCronograma';
	public $timestamps = false;

	protected $fillable = [
		'fases'
	];

	public function fases_proyectos()
	{
		return $this->hasMany(FasesProyecto::class, 'fase_cron');
	}

	public function grupos_cronogramas()
	{
		return $this->hasMany(GruposCronograma::class, 'grup_cron');
	}
}
