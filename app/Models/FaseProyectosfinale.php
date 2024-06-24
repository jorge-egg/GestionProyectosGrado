<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseProyectosfinale
 * 
 * @property int $idProyectofinal
 * @property string $documento
 * @property string $aprobacionDocen
 * @property string|null $observaDocent
 * @property string $juradoUno
 * @property string $juradoDos
 * @property string $estadoJUno
 * @property string $estadoJDos
 * @property string $estado
 * @property time without time zone|null $fecha_aplazado
 * @property int $pfin_proy
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class FaseProyectosfinale extends Model
{
	protected $table = 'fase_proyectosfinales';
	protected $primaryKey = 'idProyectofinal';

	protected $casts = [
		'fecha_aplazado' => 'time without time zone',
		'pfin_proy' => 'int'
	];

	protected $fillable = [
		'documento',
		'aprobacionDocen',
		'observaDocent',
		'juradoUno',
		'juradoDos',
		'estadoJUno',
		'estadoJDos',
		'estado',
		'fecha_aplazado',
		'pfin_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'pfin_proy');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'proyecto_final');
	}
}
