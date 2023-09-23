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
 * @property Collection|Grupo[] $grupos
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

	public function fases()
	{
		return $this->hasMany(Fase::class, 'fase_cron');
	}

	public function grupos()
	{
		return $this->hasMany(Grupo::class, 'grup_cron');
	}
}
