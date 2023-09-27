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
 * @property int $prof_fase
 * 
 * @property ProyectoFase $proyecto_fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FaseProyectosfinale extends Model
{
	protected $table = 'fase_proyectosfinales';
	protected $primaryKey = 'idProyectofinal';
	public $timestamps = false;

	protected $casts = [
		'prof_fase' => 'int'
	];

	protected $fillable = [
		'prof_fase'
	];

	public function proyecto_fase()
	{
		return $this->belongsTo(ProyectoFase::class, 'prof_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_prof');
	}
}
