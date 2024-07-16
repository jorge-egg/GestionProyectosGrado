<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FaseSustentacione
 *
 * @property int $idSustentacion
 * @property int $sust_proy
 * @property string $estado
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property SedeProyectosGrado $sede_proyectos_grado
 * @property Collection|FaseCalOb[] $fase_cal_obs
 *
 * @package App\Models
 */
class FaseSustentacione extends Model
{
	protected $table = 'fase_sustentaciones';
	protected $primaryKey = 'idSustentacion';

	protected $casts = [
		'sust_proy' => 'int'
	];

	protected $fillable = [
		'sust_proy',
		'juradoUno',
		'juradoDos',
		'estado',
	];

	public function sede_proyectos_grado()
	{
		return $this->belongsTo(SedeProyectosGrado::class, 'sust_proy');
	}

	public function fase_cal_obs()
	{
		return $this->hasMany(FaseCalOb::class, 'sustentacion');
	}
}



