<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Proyectosfinale
 * 
 * @property int $idProyectofinal
 * @property int $prof_fase
 * 
 * @property Fase $fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class Proyectosfinale extends Model
{
	protected $table = 'proyectosfinales';
	protected $primaryKey = 'idProyectofinal';
	public $timestamps = false;

	protected $casts = [
		'prof_fase' => 'int'
	];

	protected $fillable = [
		'prof_fase'
	];

	public function fase()
	{
		return $this->belongsTo(Fase::class, 'prof_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_prof');
	}
}
