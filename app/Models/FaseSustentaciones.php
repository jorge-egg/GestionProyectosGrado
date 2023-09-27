<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseSustentacione
 *
 * @property int $idSustentacion
 * @property int $Sust_fase
 *
 * @property ProyectoFase $proyecto_fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FaseSustentaciones extends Model
{
	protected $table = 'fase_sustentaciones';
	protected $primaryKey = 'idSustentacion';
	public $timestamps = false;

	protected $casts = [
		'Sust_fase' => 'int'
	];

	protected $fillable = [
		'Sust_fase'
	];

	public function proyecto_fase()
	{
		return $this->belongsTo(ProyectoFase::class, 'Sust_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_sust');
	}
}
