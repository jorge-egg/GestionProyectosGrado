<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProyectoGradosSede
 * 
 * @property int $idProyecto
 * @property string $estado
 * @property string $codigoproyecto
 * @property int $proy_sede
 * @property int $proy_bibl
 * 
 * @property Sede $sede
 * @property BibliotecasSede $bibliotecas_sede
 * @property Collection|FasesProyecto[] $fases_proyectos
 *
 * @package App\Models
 */
class ProyectoGradosSede extends Model
{
	protected $table = 'proyecto_grados_sedes';
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

	public function bibliotecas_sede()
	{
		return $this->belongsTo(BibliotecasSede::class, 'proy_bibl');
	}

	public function fases_proyectos()
	{
		return $this->hasMany(FasesProyecto::class, 'fase_proy');
	}
}
