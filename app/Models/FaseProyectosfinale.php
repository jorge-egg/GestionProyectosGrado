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
 * @property int $pfin_proy
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
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
		'pfin_proy' => 'int'
	];

	protected $fillable = [
		'pfin_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'pfin_proy');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_prof');
	}
}
