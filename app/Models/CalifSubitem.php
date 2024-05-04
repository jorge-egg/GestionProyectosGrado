<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CalifSubitem
 * 
 * @property int $idCalifSubitem
 * @property int $ValorCalifSubitem
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ValorcalifSubitem $valorcalif_subitem
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class CalifSubitem extends Model
{
	protected $table = 'calif_subitems';
	protected $primaryKey = 'idCalifSubitem';

	protected $casts = [
		'ValorCalifSubitem' => 'int'
	];

	protected $fillable = [
		'ValorCalifSubitem'
	];

	public function valorcalif_subitem()
	{
		return $this->belongsTo(ValorcalifSubitem::class, 'ValorCalifSubitem');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'calif_subitems');
	}
}
