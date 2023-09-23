<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Anteproyecto
 * 
 * @property int $idAnteproyecto
 * @property int $ante_fase
 * 
 * @property Fase $fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class Anteproyecto extends Model
{
	protected $table = 'anteproyectos';
	protected $primaryKey = 'idAnteproyecto';
	public $timestamps = false;

	protected $casts = [
		'ante_fase' => 'int'
	];

	protected $fillable = [
		'ante_fase'
	];

	public function fase()
	{
		return $this->belongsTo(Fase::class, 'ante_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_ante');
	}
}
