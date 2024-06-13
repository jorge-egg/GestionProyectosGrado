<?php

namespace App\Models;

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
 * @property string $estado
 * @property time without time zone|null $fecha_aplazado
 * @property int $ante_proy

 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at

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
	public $timestamps = true; // Habilita los timestamps

	protected $casts = [
		'fecha_aplazado' => 'time without time zone',
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
