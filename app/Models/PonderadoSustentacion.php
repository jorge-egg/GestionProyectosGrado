<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadoSustentacion
 * 
 * @property int $idPonderado_sustenta
 * @property float $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class PonderadoSustentacion extends Model
{
	protected $table = 'ponderado_sustentacion';
	protected $primaryKey = 'idPonderado_sustenta';
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
