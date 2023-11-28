<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadoProyectof
 * 
 * @property int $idPonderado_proyectof
 * @property float $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class PonderadoProyectof extends Model
{
	protected $table = 'ponderado_proyectof';
	protected $primaryKey = 'idPonderado_proyectof';
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
