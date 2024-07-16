<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseAnteproyecto
 * 
 * @property int $idAnteproyecto
 * @property string $documento
 * @property string $cartaDirector
 * @property string $aprobacionDocen
 * @property string|null $observaDocent
 * @property string $juradoUno
 * @property string $juradoDos
 * @property string $estadoJUno
 * @property string $estadoJDos
 * @property string $estado
 * @property Carbon|null $fecha_aplazado
 * @property int $ante_proy
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class FaseAnteproyecto extends Model
{
	protected $table = 'fase_anteproyectos';
	protected $primaryKey = 'idAnteproyecto';

	protected $casts = [
		'fecha_aplazado' => 'datetime',
		'ante_proy' => 'int'
	];

	protected $fillable = [
		'documento',
		'cartaDirector',
		'aprobacionDocen',
		'observaDocent',
		'juradoUno',
		'juradoDos',
		'estadoJUno',
		'estadoJDos',
		'estado',
		'fecha_aplazado',
		'ante_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'ante_proy');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'anteproyecto');
	}
}
