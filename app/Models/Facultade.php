<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Facultade
 * 
 * @property int $idFacultad
 * @property string $ingenieria
 * @property string $economia
 * @property string $artes
 * @property int $facu_sede
 * 
 * @property Sede $sede
 * @property Collection|Programa[] $programas
 *
 * @package App\Models
 */
class Facultade extends Model
{
	protected $table = 'facultades';
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

	public function programas()
	{
		return $this->hasMany(Programa::class, 'prog_facu');
	}
}
