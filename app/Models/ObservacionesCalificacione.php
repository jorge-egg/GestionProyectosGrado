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
 * @property string $titulo
 * @property string $linea_invs
 * @property string $desc_problema
 * @property string $obj_general
 * @property string $obj_especificos
 * @property int $obs_cal
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
		'obs_cal' => 'int'
	];

	protected $fillable = [
		'titulo',
		'linea_invs',
		'desc_problema',
		'obj_general',
		'obj_especificos',
		'obs_cal'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'obs_cal');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'observacion');
	}
}
