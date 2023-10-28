<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Consecutvo
 * 
 * @property int $IdConsecutivo
 * @property string $consecutivo
 * @property string $año
 * @property int $conc_sede
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Sede $sede
 *
 * @package App\Models
 */
class Consecutvo extends Model
{
	protected $table = 'consecutvo';
	protected $primaryKey = 'IdConsecutivo';

	protected $casts = [
		'conc_sede' => 'int'
	];

	protected $fillable = [
		'consecutivo',
		'año',
		'conc_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'conc_sede');
	}
}
