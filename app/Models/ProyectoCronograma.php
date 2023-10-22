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
 * @property string $fases
 * 
 * @property Collection|ProyectoFase[] $proyecto_fases
 *
 * @package App\Models
 */
class ProyectoCronograma extends Model
{
	protected $table = 'proyecto_cronogramas';
	protected $primaryKey = 'idCronograma';
	public $timestamps = false;

	protected $fillable = [
		'fases'
	];

	public function proyecto_fases()
	{
		return $this->hasMany(ProyectoFase::class, 'fase_cron');
	}
}
