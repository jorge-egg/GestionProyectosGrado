<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoGrado
 * 
 * @property int $idProyecto
 * @property string $estado
 * @property string $codigoproyecto
 * @property int $proy_sede
 * @property int $proy_bibl
 * 
 * @property Sede $sede
 * @property Biblioteca $biblioteca
 * @property Collection|Fase[] $fases
 *
 * @package App\Models
 */
class ProyectoGrado extends Model
{
	protected $table = 'proyecto_grados';
	protected $primaryKey = 'idProyecto';
	public $timestamps = false;

	protected $casts = [
		'proy_sede' => 'int',
		'proy_bibl' => 'int'
	];

	protected $fillable = [
		'estado',
		'codigoproyecto',
		'proy_sede',
		'proy_bibl'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'proy_sede');
	}

	public function biblioteca()
	{
		return $this->belongsTo(Biblioteca::class, 'proy_bibl');
	}

	public function fases()
	{
		return $this->hasMany(Fase::class, 'fase_proy');
	}
}
