<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FasePropuesta
 * 
 * @property int $idPropuesta
 * @property string $titulo
 * @property string $linea_invs
 * @property string $desc_problema
 * @property string $obj_general
 * @property string $obj_especificos
 * @property string $estado
 * @property string $fecha_cierre
 * @property int $prop_proy
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FasePropuesta extends Model
{
	protected $table = 'fase_propuestas';
	protected $primaryKey = 'idPropuesta';

	protected $casts = [
		'prop_proy' => 'int'
	];

	protected $fillable = [
		'titulo',
		'linea_invs',
		'desc_problema',
		'obj_general',
		'obj_especificos',
		'estado',
		'fecha_cierre',
		'prop_proy'
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'prop_proy');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_pro');
	}
}
