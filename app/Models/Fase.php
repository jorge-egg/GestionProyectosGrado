<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Fase
 * 
 * @property int $idFase
 * @property string $estado
 * @property int $fase_proy
 * @property int $fase_cron
 * 
 * @property ProyectoGrado $proyecto_grado
 * @property Cronograma $cronograma
 * @property Collection|Propuesta[] $propuestas
 * @property Collection|Anteproyecto[] $anteproyectos
 * @property Collection|Proyectosfinale[] $proyectosfinales
 * @property Collection|Sustentacion[] $sustentacions
 *
 * @package App\Models
 */
class Fase extends Model
{
	protected $table = 'fases';
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

	public function proyecto_grado()
	{
		return $this->belongsTo(ProyectoGrado::class, 'fase_proy');
	}

	public function cronograma()
	{
		return $this->belongsTo(Cronograma::class, 'fase_cron');
	}

	public function propuestas()
	{
		return $this->hasMany(Propuesta::class, 'prop_fase');
	}

	public function anteproyectos()
	{
		return $this->hasMany(Anteproyecto::class, 'ante_fase');
	}

	public function proyectosfinales()
	{
		return $this->hasMany(Proyectosfinale::class, 'prof_fase');
	}

	public function sustentacions()
	{
		return $this->hasMany(Sustentacion::class, 'Sust_fase');
	}
}
