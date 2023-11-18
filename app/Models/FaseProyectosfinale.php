<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseProyectosfinale
 * 
 * @property int $idProyectofinal
 * @property int $pfin_proy
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|PonderadosCalificacione[] $ponderados_calificaciones
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class FaseProyectosfinale extends Model
{
	protected $table = 'fase_proyectosfinales';
	protected $primaryKey = 'idProyectofinal';
	public $timestamps = false;

	protected $casts = [
		'pfin_proy' => 'int'
	];

	protected $fillable = [
		'pfin_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'pfin_proy');
	}

	public function ponderados_calificaciones()
	{
		return $this->hasMany(PonderadosCalificacione::class, 'proyecto_final');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'proyecto_final');
	}
}
