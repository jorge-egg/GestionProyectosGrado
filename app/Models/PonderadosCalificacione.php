<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadosCalificacione
 * 
 * @property int $idPonderado
 * @property float $ponderado
 * @property int $item_pond
 * 
 * @property Item $item
 *
 * @package App\Models
 */
class PonderadosCalificacione extends Model
{
	protected $table = 'ponderados_calificaciones';
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
