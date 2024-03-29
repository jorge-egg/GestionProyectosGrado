<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calificacione
 * 
 * @property int $idCalificacion
 * @property float $calificacion
 * @property int $cal_item
 * 
 * @property Item $item
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class Calificacione extends Model
{
	protected $table = 'calificaciones';
	protected $primaryKey = 'idCalificacion';
	public $timestamps = false;

	protected $casts = [
		'calificacion' => 'float',
		'cal_item' => 'int'
	];

	protected $fillable = [
		'calificacion',
		'cal_item'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'cal_item');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'calificacion_fase');
	}
}
