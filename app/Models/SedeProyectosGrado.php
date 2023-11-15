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
 * @property bool $estado
 * @property string $codigoproyecto
 * @property int $proy_sede
 * @property int $proy_bibl
 * 
 * @property Sede $sede
 * @property SedeBiblioteca $sede_biblioteca
 * @property Collection|Integrante[] $integrantes
 * @property Collection|FasePropuesta[] $fase_propuestas
 * @property Collection|FaseAnteproyecto[] $fase_anteproyectos
 * @property Collection|FaseProyectosfinale[] $fase_proyectosfinales
 * @property Collection|FaseSustentacione[] $fase_sustentaciones
 *
 * @package App\Models
 */
class SedeProyectosGrado extends Model
{
	protected $table = 'sede_proyectos_grado';
	protected $primaryKey = 'idProyecto';
	public $timestamps = false;

	protected $casts = [
		'estado' => 'bool',
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

	public function integrantes()
	{
		return $this->hasMany(Integrante::class, 'proyecto');
	}

	public function fase_propuestas()
	{
		return $this->hasMany(FasePropuesta::class, 'prop_proy');
	}

	public function fase_anteproyectos()
	{
		return $this->hasMany(FaseAnteproyecto::class, 'ante_proy');
	}

	public function fase_proyectosfinales()
	{
		return $this->hasMany(FaseProyectosfinale::class, 'pfin_proy');
	}

	public function fase_sustentaciones()
	{
		return $this->hasMany(FaseSustentacione::class, 'sust_proy');
	}
}
