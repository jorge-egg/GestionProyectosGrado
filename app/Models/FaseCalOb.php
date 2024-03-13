<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseCalOb
 * 
 * @property int $id
 * @property int $calificacion_fase
 * @property int|null $propuesta
 * @property int|null $anteproyecto
 * @property int|null $proyecto_final
 * @property int|null $sustentacion
 * @property int $observacion_fase
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Calificacione $calificacione
 * @property FasePropuesta|null $fase_propuesta
 * @property FaseAnteproyecto|null $fase_anteproyecto
 * @property FaseProyectosfinale|null $fase_proyectosfinale
 * @property FaseSustentacione|null $fase_sustentacione
 * @property ObservacionesCalificacione $observaciones_calificacione
 *
 * @package App\Models
 */
class FaseCalOb extends Model
{
	protected $table = 'fase_cal_obs';

	protected $casts = [
		'calificacion_fase' => 'int',
		'propuesta' => 'int',
		'anteproyecto' => 'int',
		'proyecto_final' => 'int',
		'sustentacion' => 'int',
		'observacion_fase' => 'int'
	];

	protected $fillable = [
		'calificacion_fase',
		'propuesta',
		'anteproyecto',
		'proyecto_final',
		'sustentacion',
		'observacion_fase'
	];

	public function calificacione()
	{
		return $this->belongsTo(Calificacione::class, 'calificacion_fase');
	}

	public function fase_propuesta()
	{
		return $this->belongsTo(FasePropuesta::class, 'propuesta');
	}

	public function fase_anteproyecto()
	{
		return $this->belongsTo(FaseAnteproyecto::class, 'anteproyecto');
	}

	public function fase_proyectosfinale()
	{
		return $this->belongsTo(FaseProyectosfinale::class, 'proyecto_final');
	}

	public function fase_sustentacione()
	{
		return $this->belongsTo(FaseSustentacione::class, 'sustentacion');
	}

	public function observaciones_calificacione()
	{
		return $this->belongsTo(ObservacionesCalificacione::class, 'observacion_fase');
	}
}
