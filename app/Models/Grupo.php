<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Grupo
 * 
 * @property int $idGrupo
 * @property string $numerogrupo
 * @property string $estado
 * @property int $grup_cron
 * 
 * @property Cronograma $cronograma
 * @property Collection|Fecha[] $fechas
 *
 * @package App\Models
 */
class Grupo extends Model
{
	protected $table = 'grupos';
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

	public function fechas()
	{
		return $this->hasMany(Fecha::class, 'fech_grup');
	}
}
