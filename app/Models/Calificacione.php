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
 * @property Propuesta $propuesta
 * @property Anteproyecto $anteproyecto
 * @property Proyectosfinale $proyectosfinale
 * @property Sustentacion $sustentacion
 * @property Collection|Ponderado[] $ponderados
 * @property Collection|Observacione[] $observaciones
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

	public function propuesta()
	{
		return $this->belongsTo(Propuesta::class, 'cal_pro');
	}

	public function anteproyecto()
	{
		return $this->belongsTo(Anteproyecto::class, 'cal_ante');
	}

	public function proyectosfinale()
	{
		return $this->belongsTo(Proyectosfinale::class, 'cal_prof');
	}

	public function sustentacion()
	{
		return $this->belongsTo(Sustentacion::class, 'cal_sust');
	}

	public function ponderados()
	{
		return $this->hasMany(Ponderado::class, 'pond_cal');
	}

	public function observaciones()
	{
		return $this->hasMany(Observacione::class, 'obse_cal');
	}
}
