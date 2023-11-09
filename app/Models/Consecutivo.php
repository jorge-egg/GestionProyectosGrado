<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Consecutivo
 *
 * @property int $IdConsecutivo
 * @property int $consecutivo
 * @property string $año
 * @property int $conc_sede
 *
 * @property Sede $sede
 *
 * @package App\Models
 */
class Consecutivo extends Model
{
	protected $table = 'consecutivo';
	protected $primaryKey = 'IdConsecutivo';
	public $timestamps = false;

	protected $casts = [
		'consecutivo' => 'int',
		'conc_sede' => 'int'
	];

	protected $fillable = [
		'consecutivo',
		'ano',
		'conc_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'conc_sede');
	}
}
