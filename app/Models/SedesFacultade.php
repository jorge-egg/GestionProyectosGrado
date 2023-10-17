<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SedesFacultade
 *
 * @property int $idFacultad
 * @property string $ingenieria
 * @property string $economia
 * @property string $artes
 * @property int $facu_sede
 *
 * @property Sede $sede
 * @property Collection|SedePrograma[] $sede_programas
 *
 * @package App\Models
 */
class SedesFacultade extends Model
{
	protected $table = 'sedes_facultades';
	protected $primaryKey = 'idFacultad';
	public $timestamps = false;

	protected $fillable = [
		'nombre',
        'facu_sede',
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'facu_sede');
	}

	public function sede_programas()
	{
		return $this->hasMany(SedePrograma::class, 'prog_facu');
	}
}
