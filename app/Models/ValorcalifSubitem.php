<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ValorcalifSubitem
 * 
 * @property int $idValorCalifSubitem
 * @property string $valor
 * 
 * @property Collection|CalifSubitem[] $calif_subitems
 *
 * @package App\Models
 */
class ValorcalifSubitem extends Model
{
	protected $table = 'valorcalif_subitems';
	protected $primaryKey = 'idValorCalifSubitem';
	public $timestamps = false;

	protected $fillable = [
		'valor'
	];

	public function calif_subitems()
	{
		return $this->hasMany(CalifSubitem::class, 'ValorCalifSubitem');
	}
}
