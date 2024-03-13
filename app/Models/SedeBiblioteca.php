<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SedeBiblioteca
 * 
 * @property int $idBiblioteca
 * @property int $bibl_sede
 * 
 * @property Sede $sede
 * @property Collection|SedeProyectosGrado[] $sede_proyectos_grados
 *
 * @package App\Models
 */
class SedeBiblioteca extends Model
{
	protected $table = 'sede_bibliotecas';
	protected $primaryKey = 'idBiblioteca';
	public $timestamps = false;

	protected $casts = [
		'bibl_sede' => 'int'
	];

	protected $fillable = [
		'bibl_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'bibl_sede');
	}

	public function sede_proyectos_grados()
	{
		return $this->hasMany(SedeProyectosGrado::class, 'proy_bibl');
	}
}
