<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Sustentacion
 * 
 * @property int $idSustentacion
 * @property int $Sust_fase
 * 
 * @property Fase $fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class Sustentacion extends Model
{
	protected $table = 'sustentacions';
	protected $primaryKey = 'idSustentacion';
	public $timestamps = false;

	protected $casts = [
		'Sust_fase' => 'int'
	];

	protected $fillable = [
		'Sust_fase'
	];

	public function fase()
	{
		return $this->belongsTo(Fase::class, 'Sust_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_sust');
	}
}
