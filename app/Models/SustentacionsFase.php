<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SustentacionsFase
 * 
 * @property int $idSustentacion
 * @property int $Sust_fase
 * 
 * @property FasesProyecto $fases_proyecto
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class SustentacionsFase extends Model
{
	protected $table = 'sustentacions_fases';
	protected $primaryKey = 'idSustentacion';
	public $timestamps = false;

	protected $casts = [
		'Sust_fase' => 'int'
	];

	protected $fillable = [
		'Sust_fase'
	];

	public function fases_proyecto()
	{
		return $this->belongsTo(FasesProyecto::class, 'Sust_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_sust');
	}
}
