<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FacultadesSede
 * 
 * @property int $idFacultad
 * @property string $ingenieria
 * @property string $economia
 * @property string $artes
 * @property int $facu_sede
 * 
 * @property Sede $sede
 * @property Collection|ProgramasSede[] $programas_sedes
 *
 * @package App\Models
 */
class FacultadesSede extends Model
{
	protected $table = 'facultades_sedes';
	protected $primaryKey = 'idFacultad';
	public $timestamps = false;

	protected $casts = [
		'facu_sede' => 'int'
	];

	protected $fillable = [
		'ingenieria',
		'economia',
		'artes',
		'facu_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'facu_sede');
	}

	public function programas_sedes()
	{
		return $this->hasMany(ProgramasSede::class, 'prog_facu');
	}
}
