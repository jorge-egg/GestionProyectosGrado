<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadoAnteproyecto
 * 
 * @property int $idPonderado_antep
 * @property float $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class PonderadoAnteproyecto extends Model
{
	protected $table = 'ponderado_anteproyecto';
	protected $primaryKey = 'idPonderado_antep';
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
