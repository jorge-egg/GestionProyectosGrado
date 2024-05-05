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
 * @property Collection|PonderadosPropuestum[] $ponderados_propuesta
 * @property Collection|PonderadoAnteproyecto[] $ponderado_anteproyectos
 * @property Collection|PonderadoProyectof[] $ponderado_proyectofs
 * @property Collection|PonderadoSustentacion[] $ponderado_sustentacions
 * @property Collection|SubItem[] $sub_items
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
		return $this->hasMany(PonderadosPropuestum::class, 'item_pond');
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

	public function sub_items()
	{
		return $this->hasMany(SubItem::class, 'item');
	}
}
