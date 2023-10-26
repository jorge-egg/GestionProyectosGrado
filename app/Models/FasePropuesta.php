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
 * @property int $prop_fase
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ProyectoFase $proyecto_fase
 * @property Collection|Calificacione[] $calificaciones
 *
 * @package App\Models
 */
class FasePropuesta extends Model
{
	protected $table = 'fase_propuestas';
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
		'estado',
		'fecha_cierre',
		'prop_fase'
	];

	public function proyecto_fase()
	{
		return $this->belongsTo(ProyectoFase::class, 'prop_fase');
	}

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_pro');
	}
}
