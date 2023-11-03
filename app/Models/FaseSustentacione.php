<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseSustentacione
 * 
 * @property int $idSustentacion
 * @property int $sust_proy
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FaseSustentacione extends Model
{
	protected $table = 'fase_sustentaciones';
	protected $primaryKey = 'idSustentacion';
	public $timestamps = false;

	protected $casts = [
		'sust_proy' => 'int'
	];

	protected $fillable = [
		'sust_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'sust_proy');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_sust');
	}
}
