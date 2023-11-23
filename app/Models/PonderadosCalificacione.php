<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadosCalificacione
 * 
 * @property int $idPonderado
 * @property string $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class PonderadosCalificacione extends Model
{
	protected $table = 'ponderados_calificaciones';
	protected $primaryKey = 'idPonderado';
	public $timestamps = false;

	protected $casts = [
		'item_pond' => 'int'
	];

	protected $fillable = [
		'ponderado',
		'item_pond'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_pond');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'ponderado');
	}
}
