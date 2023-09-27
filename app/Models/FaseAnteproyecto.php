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
 * @property int $ante_fase
 * 
 * @property ProyectoFase $proyecto_fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FaseAnteproyecto extends Model
{
	protected $table = 'fase_anteproyectos';
	protected $primaryKey = 'idAnteproyecto';
	public $timestamps = false;

	protected $casts = [
		'ante_fase' => 'int'
	];

	protected $fillable = [
		'ante_fase'
	];

	public function proyecto_fase()
	{
		return $this->belongsTo(ProyectoFase::class, 'ante_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_ante');
	}
}
