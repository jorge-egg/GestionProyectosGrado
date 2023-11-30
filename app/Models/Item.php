<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Item
 *
 * @property int $idItem
 * @property string $item
 *
 * @property Collection|Calificacione[] $calificaciones
 * @property Collection|PonderadosCalificacione[] $ponderados_calificaciones
 * @property Collection|ObservacionesCalificacione[] $observaciones_calificaciones
 * @property Collection|PonderadoAnteproyecto[] $ponderado_anteproyectos
 * @property Collection|PonderadoProyectof[] $ponderado_proyectofs
 * @property Collection|PonderadoSustentacion[] $ponderado_sustentacions
 *
 * @package App\Models
 */
class Item extends Model
{
	protected $table = 'items';
	protected $primaryKey = 'idItem';
	public $timestamps = false;

	protected $fillable = [
		'item'
	];

	public function calificaciones()
	{
		return $this->hasMany(Calificacione::class, 'cal_item');
	}

	public function ponderados_propuesta()
	{
		return $this->hasMany(PonderadosPropuesta::class, 'item_pond');
	}

	public function observaciones_calificaciones()
	{
		return $this->hasMany(ObservacionesCalificacione::class, 'obs_item');
	}

	public function ponderado_anteproyectos()
	{
		return $this->hasMany(PonderadoAnteproyecto::class, 'item_pond');
	}

	public function ponderado_proyectofs()
	{
		return $this->hasMany(PonderadoProyectof::class, 'item_pond');
	}

	public function ponderado_sustentacions()
	{
		return $this->hasMany(PonderadoSustentacion::class, 'item_pond');
	}
}
