<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PropuestasFase
 * 
 * @property int $idPropuesta
 * @property string $titulo
 * @property string $linea_invs
 * @property string $desc_problema
 * @property string $obj_general
 * @property string $obj_especificos
 * @property string $frecha_subida
 * @property string $frecha_actu
 * @property string $calificacion
 * @property string $estado
 * @property string $fecha_cierre
 * @property int $prop_fase
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property FasesProyecto $fases_proyecto
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class PropuestasFase extends Model
{
	protected $table = 'propuestas_fases';
	protected $primaryKey = 'idPropuesta';

	protected $casts = [
		'prop_fase' => 'int'
	];

	protected $fillable = [
		'titulo',
		'linea_invs',
		'desc_problema',
		'obj_general',
		'obj_especificos',
		'frecha_subida',
		'frecha_actu',
		'calificacion',
		'estado',
		'fecha_cierre',
		'prop_fase'
	];

	public function fases_proyecto()
	{
		return $this->belongsTo(FasesProyecto::class, 'prop_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_pro');
	}
}
