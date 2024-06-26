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
 * @property string $codigo
 * @property string $SubItem
 * @property int $item
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CalifSubitem[] $calif_subitems
 *
 * @package App\Models
 */
class SubItem extends Model
{
	protected $table = 'sub_items';
	protected $primaryKey = 'idSubitem';

	protected $casts = [
		'item' => 'int'
	];

	protected $fillable = [
		'codigo',
		'SubItem',
		'item'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item');
	}

	public function calif_subitems()
	{
		return $this->hasMany(CalifSubitem::class, 'subitem');
	}
}
