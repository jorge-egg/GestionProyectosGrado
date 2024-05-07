<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ValorcalifSubitem
 * 
 * @property int $idValorCalifSubitem
 * @property string $valor
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
}
