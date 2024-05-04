<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SubItem
 * 
 * @property int $idSubitem
 * @property string $SubItem
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Item[] $items
 *
 * @package App\Models
 */
class SubItem extends Model
{
	protected $table = 'sub_items';
	protected $primaryKey = 'idSubitem';

	protected $fillable = [
		'SubItem'
	];

	public function items()
	{
		return $this->hasMany(Item::class, 'sub_items');
	}
}
