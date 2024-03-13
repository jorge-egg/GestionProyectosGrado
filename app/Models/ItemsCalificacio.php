<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ItemsCalificacio
 * 
 * @property int $idItem
 * @property string $items
 * @property int $item_cali
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Calificacione $calificacione
 *
 * @package App\Models
 */
class ItemsCalificacio extends Model
{
	protected $table = 'items_calificacioes';
	protected $primaryKey = 'idItem';

	protected $casts = [
		'item_cali' => 'int'
	];

	protected $fillable = [
		'items',
		'item_cali'
	];

	public function calificacione()
	{
		return $this->belongsTo(Calificacione::class, 'item_cali');
	}
}
