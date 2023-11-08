<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FasesCronograma
 * 
 * @property int $idFase
 * @property string $fase
 * @property int $fase_cron
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProyectoCronograma $proyecto_cronograma
 *
 * @package App\Models
 */
class FasesCronograma extends Model
{
	protected $table = 'fases_cronogramas';
	protected $primaryKey = 'idFase';

	protected $casts = [
		'fase_cron' => 'int'
	];

	protected $fillable = [
		'fase',
		'fase_cron'
	];

	public function proyecto_cronograma()
	{
		return $this->belongsTo(ProyectoCronograma::class, 'fase_cron');
	}
}
