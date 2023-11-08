<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Calificacione
 * 
 * @property int $idCalificacion
 * @property float $calificacion
 * @property int $cal_pro
 * @property int $cal_ante
 * @property int $cal_prof
 * @property int $cal_sust
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property FasePropuesta $fase_propuesta
 * @property FaseAnteproyecto $fase_anteproyecto
 * @property FaseProyectosfinale $fase_proyectosfinale
 * @property FaseSustentacione $fase_sustentacione
 * @property Collection|PonderadosCalificacione[] $ponderados_calificaciones
 * @property Collection|ObservacionesCalificacione[] $observaciones_calificaciones
 * @property Collection|ItemsCalificacio[] $items_calificacios
 *
 * @package App\Models
 */
class Calificacione extends Model
{
	protected $table = 'calificaciones';
	protected $primaryKey = 'idCalificacion';

	protected $casts = [
		'calificacion' => 'float',
		'cal_pro' => 'int',
		'cal_ante' => 'int',
		'cal_prof' => 'int',
		'cal_sust' => 'int'
	];

	protected $fillable = [
		'calificacion',
		'cal_pro',
		'cal_ante',
		'cal_prof',
		'cal_sust'
	];

	public function fase_propuesta()
	{
		return $this->belongsTo(FasePropuesta::class, 'cal_pro');
	}

	public function fase_anteproyecto()
	{
		return $this->belongsTo(FaseAnteproyecto::class, 'cal_ante');
	}

	public function fase_proyectosfinale()
	{
		return $this->belongsTo(FaseProyectosfinale::class, 'cal_prof');
	}

	public function fase_sustentacione()
	{
		return $this->belongsTo(FaseSustentacione::class, 'cal_sust');
	}

	public function ponderados_calificaciones()
	{
		return $this->hasMany(PonderadosCalificacione::class, 'pond_cal');
	}

	public function observaciones_calificaciones()
	{
		return $this->hasMany(ObservacionesCalificacione::class, 'obse_cal');
	}

	public function items_calificacios()
	{
		return $this->hasMany(ItemsCalificacio::class, 'item_cali');
	}
}
