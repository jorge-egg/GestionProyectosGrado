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
 * @property string $cal_investigacion
 * @property string $cal_Descproblema
 * @property string $cal_titulo
 * @property string $cal_objgeneral
 * @property string $cal_objespecificos
 * @property int $cal_pro
 * @property int $cal_ante
 * @property int $cal_prof
 * @property int $cal_sust
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property PropuestasFase $propuestas_fase
 * @property AnteproyectosFase $anteproyectos_fase
 * @property ProyectosfinalesFase $proyectosfinales_fase
 * @property SustentacionsFase $sustentacions_fase
 * @property Collection|ObservacionesCalificacione[] $observaciones_calificaciones
 * @property Collection|PonderadosCalificacione[] $ponderados_calificaciones
 *
 * @package App\Models
 */
class Calificacione extends Model
{
	protected $table = 'calificaciones';
	protected $primaryKey = 'idCalificacion';

	protected $casts = [
		'cal_pro' => 'int',
		'cal_ante' => 'int',
		'cal_prof' => 'int',
		'cal_sust' => 'int'
	];

	protected $fillable = [
		'cal_investigacion',
		'cal_Descproblema',
		'cal_titulo',
		'cal_objgeneral',
		'cal_objespecificos',
		'cal_pro',
		'cal_ante',
		'cal_prof',
		'cal_sust'
	];

	public function propuestas_fase()
	{
		return $this->belongsTo(PropuestasFase::class, 'cal_pro');
	}

	public function anteproyectos_fase()
	{
		return $this->belongsTo(AnteproyectosFase::class, 'cal_ante');
	}

	public function proyectosfinales_fase()
	{
		return $this->belongsTo(ProyectosfinalesFase::class, 'cal_prof');
	}

	public function sustentacions_fase()
	{
		return $this->belongsTo(SustentacionsFase::class, 'cal_sust');
	}

	public function observaciones_calificaciones()
	{
		return $this->hasMany(ObservacionesCalificacione::class, 'obse_cal');
	}

	public function ponderados_calificaciones()
	{
		return $this->hasMany(PonderadosCalificacione::class, 'pond_cal');
	}
}
