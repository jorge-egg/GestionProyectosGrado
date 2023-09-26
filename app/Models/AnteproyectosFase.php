<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AnteproyectosFase
 * 
 * @property int $idAnteproyecto
 * @property int $ante_fase
 * 
 * @property FasesProyecto $fases_proyecto
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class AnteproyectosFase extends Model
{
	protected $table = 'anteproyectos_fases';
	protected $primaryKey = 'idAnteproyecto';
	public $timestamps = false;

	protected $casts = [
		'ante_fase' => 'int'
	];

	protected $fillable = [
		'ante_fase'
	];

	public function fases_proyecto()
	{
		return $this->belongsTo(FasesProyecto::class, 'ante_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_ante');
	}
}
