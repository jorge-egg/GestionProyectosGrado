<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 * 
 * @property int $idItem
 * @property string $item
 * 
 * @property Collection|Calificacione[] $calificaciones
 * @property Collection|ObservacionesCalificacione[] $observaciones_calificaciones
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';
	protected $primaryKey = 'idItem';
	public $timestamps = false;

	protected $fillable = [
		'item'
	];

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_item');
	}

	public function observaciones_calificaciones()
	{
		return $this->hasMany(ObservacionesCalificacione::class, 'obs_cal');
	}
}
