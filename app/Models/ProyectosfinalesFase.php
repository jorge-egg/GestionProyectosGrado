<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectosfinalesFase
 * 
 * @property int $idProyectofinal
 * @property int $prof_fase
 * 
 * @property FasesProyecto $fases_proyecto
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class ProyectosfinalesFase extends Model
{
	protected $table = 'proyectosfinales_fases';
	protected $primaryKey = 'idProyectofinal';
	public $timestamps = false;

	protected $casts = [
		'prof_fase' => 'int'
	];

	protected $fillable = [
		'prof_fase'
	];

	public function fases_proyecto()
	{
		return $this->belongsTo(FasesProyecto::class, 'prof_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_prof');
	}
}
