<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class GruposCronograma
 * 
 * @property int $idGrupo
 * @property string $numerogrupo
 * @property string $estado
 * @property int $grup_cron
 * 
 * @property Cronograma $cronograma
 * @property Collection|FechasGrupo[] $fechas_grupos
 *
 * @package App\Models
 */
class GruposCronograma extends Model
{
	protected $table = 'grupos_cronogramas';
	protected $primaryKey = 'idGrupo';
	public $timestamps = false;

	protected $casts = [
		'grup_cron' => 'int'
	];

	protected $fillable = [
		'numerogrupo',
		'estado',
		'grup_cron'
	];

	public function cronograma()
	{
		return $this->belongsTo(Cronograma::class, 'grup_cron');
	}

	public function fechas_grupos()
	{
		return $this->hasMany(FechasGrupo::class, 'fech_grup');
	}
}
