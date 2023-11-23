<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PonderadosCalificacione
 * 
 * @property int $idPonderado
 * @property string $ponderado
 * @property int $item_pond
 * @property int|null $propuesta
 * @property int|null $anteproyecto
 * @property int|null $proyecto_final
 * @property int|null $sustentacion
 * 
 * @property Item $item
 * @property FasePropuesta|null $fase_propuesta
 * @property FaseAnteproyecto|null $fase_anteproyecto
 * @property FaseProyectosfinale|null $fase_proyectosfinale
 * @property FaseSustentacione|null $fase_sustentacione
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class PonderadosCalificacione extends Model
{
	protected $table = 'ponderados_calificaciones';
	protected $primaryKey = 'idPonderado';
	public $timestamps = false;

	protected $casts = [
		'item_pond' => 'int',
		'propuesta' => 'int',
		'anteproyecto' => 'int',
		'proyecto_final' => 'int',
		'sustentacion' => 'int'
	];

	protected $fillable = [
		'ponderado',
		'item_pond',
		'propuesta',
		'anteproyecto',
		'proyecto_final',
		'sustentacion'
	];

	public function item()
	{
		return $this->belongsTo(Item::class, 'item_pond');
	}

	public function fase_propuesta()
	{
		return $this->belongsTo(FasePropuesta::class, 'propuesta');
	}

	public function fase_anteproyecto()
	{
		return $this->belongsTo(FaseAnteproyecto::class, 'anteproyecto');
	}

	public function fase_proyectosfinale()
	{
		return $this->belongsTo(FaseProyectosfinale::class, 'proyecto_final');
	}

	public function fase_sustentacione()
	{
		return $this->belongsTo(FaseSustentacione::class, 'sustentacion');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'ponderado');
	}
}
