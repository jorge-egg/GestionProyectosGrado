<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FasesProyecto
 * 
 * @property int $idFase
 * @property string $estado
 * @property int $fase_proy
 * @property int $fase_cron
 * 
 * @property ProyectoGradosSede $proyecto_grados_sede
 * @property Cronograma $cronograma
 * @property Collection|PropuestasFase[] $propuestas_fases
 * @property Collection|AnteproyectosFase[] $anteproyectos_fases
 * @property Collection|ProyectosfinalesFase[] $proyectosfinales_fases
 * @property Collection|SustentacionsFase[] $sustentacions_fases
 *
 * @package App\Models
 */
class FasesProyecto extends Model
{
	protected $table = 'fases_proyectos';
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

	public function proyecto_grados_sede()
	{
		return $this->belongsTo(ProyectoGradosSede::class, 'fase_proy');
	}

	public function cronograma()
	{
		return $this->belongsTo(Cronograma::class, 'fase_cron');
	}

	public function propuestas_fases()
	{
		return $this->hasMany(PropuestasFase::class, 'prop_fase');
	}

	public function anteproyectos_fases()
	{
		return $this->hasMany(AnteproyectosFase::class, 'ante_fase');
	}

	public function proyectosfinales_fases()
	{
		return $this->hasMany(ProyectosfinalesFase::class, 'prof_fase');
	}

	public function sustentacions_fases()
	{
		return $this->hasMany(SustentacionsFase::class, 'Sust_fase');
	}
}
