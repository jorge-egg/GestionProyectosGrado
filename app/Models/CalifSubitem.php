<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class CalifSubitem
 * 
 * @property int $idCalifSubitem
 * @property int $ValorCalifSubitem
 * @property int $subitem
 * @property int|null $calificacion
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ValorcalifSubitem $valorcalif_subitem
 * @property SubItem $sub_item
 * @property Calificacione|null $calificacione
 *
 * @package App\Models
 */
class CalifSubitem extends Model
{
	protected $table = 'calif_subitems';
	protected $primaryKey = 'idCalifSubitem';

	protected $casts = [
		'ValorCalifSubitem' => 'int',
		'subitem' => 'int',
		'calificacion' => 'int'
	];

	protected $fillable = [
		'ValorCalifSubitem',
		'subitem',
		'calificacion'
	];

	public function valorcalif_subitem()
	{
		return $this->belongsTo(ValorcalifSubitem::class, 'ValorCalifSubitem');
	}

	public function sub_item()
	{
		return $this->belongsTo(SubItem::class, 'subitem');
	}

	public function calificacione()
	{
		return $this->belongsTo(Calificacione::class, 'calificacion');
	}
}
