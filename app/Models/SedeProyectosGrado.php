<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SedeProyectosGrado
 *
 * @property int $idProyecto
 * @property string $estado
 * @property string $codigoproyecto
 * @property int $proy_sede
 * @property int $proy_bibl
 *
 * @property Sede $sede
 * @property SedeBiblioteca $sede_biblioteca
 * @property Collection|ProyectoFase[] $proyecto_fases
 * @property Collection|Integrante[] $integrantes
 *
 * @package App\Models
 */
class SedeProyectosGrado extends Model
{
	protected $table = 'sede_proyectos_grado';
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

	public function sede_biblioteca()
	{
		return $this->belongsTo(SedeBiblioteca::class, 'proy_bibl');
	}

	public function proyecto_fases()
	{
		return $this->hasMany(ProyectoFase::class, 'fase_proy');
	}

	public function integrantes()
	{
		return $this->hasMany(Integrante::class, 'proyecto');
	}
}
