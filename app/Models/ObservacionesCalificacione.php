<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ObservacionesCalificacione
 * 
 * @property int $idObservacion
 * @property string $observacion
 * @property int $obs_item
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Item $item
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class ObservacionesCalificacione extends Model
{
	protected $table = 'observaciones_calificaciones';
	protected $primaryKey = 'idObservacion';

	protected $casts = [
		'obs_item' => 'int'
	];

	protected $fillable = [
		'observacion',
		'obs_item'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'obs_item');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'observacion');
	}
}
