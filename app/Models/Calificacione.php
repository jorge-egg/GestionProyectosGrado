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
 * @property string $observacion
 * @property int $cal_item
 * 
 * @property Item $item
 * @property Collection|CalifSubitem[] $calif_subitems
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
		'observacion',
		'cal_item'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'cal_item');
	}

	public function calif_subitems()
	{
		return $this->hasMany(CalifSubitem::class, 'calificacion');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'calificacion_fase');
	}
}
