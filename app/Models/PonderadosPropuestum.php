<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadosPropuestum
 * 
 * @property int $idPonderado
 * @property float $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class PonderadosPropuestum extends Model
{
	protected $table = 'ponderados_propuesta';
	protected $primaryKey = 'idPonderado';
	public $timestamps = false;

	protected $casts = [
		'ponderado' => 'float',
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
}
