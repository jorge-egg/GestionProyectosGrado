<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoFase
 * 
 * @property int $idFase
 * @property string $estado
 * @property int $fase_proy
 * @property int $fase_cron
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property ProyectoCronograma $proyecto_cronograma
 * @property Collection|FasePropuesta[] $fase_propuestas
 * @property Collection|FaseAnteproyecto[] $fase_anteproyectos
 * @property Collection|FaseProyectosfinale[] $fase_proyectosfinales
 * @property Collection|FaseSustentacione[] $fase_sustentaciones
 *
 * @package App\Models
 */
class ProyectoFase extends Model
{
	protected $table = 'proyecto_fases';
	protected $primaryKey = 'idFase';
	public $timestamps = false;

	protected $casts = [
		'fase_proy' => 'int',
		'fase_cron' => 'int'
	];

	protected $fillable = [
		'estado',
		'fase_proy',
		'fase_cron'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'fase_proy');
	}

	public function proyecto_cronograma()
	{
		return $this->belongsTo(ProyectoCronograma::class, 'fase_cron');
	}

	public function fase_propuestas()
	{
		return $this->hasMany(FasePropuesta::class, 'prop_fase');
	}

	public function fase_anteproyectos()
	{
		return $this->hasMany(FaseAnteproyecto::class, 'ante_fase');
	}

	public function fase_proyectosfinales()
	{
		return $this->hasMany(FaseProyectosfinale::class, 'prof_fase');
	}

	public function fase_sustentaciones()
	{
		return $this->hasMany(FaseSustentacione::class, 'Sust_fase');
	}
}
