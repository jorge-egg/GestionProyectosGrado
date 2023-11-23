<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseAnteproyecto
 * 
 * @property int $idAnteproyecto
 * @property int $ante_proy
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|PonderadosCalificacione[] $ponderados_calificaciones
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class FaseAnteproyecto extends Model
{
	protected $table = 'fase_anteproyectos';
	protected $primaryKey = 'idAnteproyecto';
	public $timestamps = false;

	protected $casts = [
		'ante_proy' => 'int'
	];

	protected $fillable = [
		'ante_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'ante_proy');
	}

	public function ponderados_calificaciones()
	{
		return $this->hasMany(PonderadosCalificacione::class, 'anteproyecto');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'anteproyecto');
	}
}
