<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BibliotecasSede
 * 
 * @property int $idBiblioteca
 * @property int $bibl_sede
 * 
 * @property Sede $sede
 * @property Collection|ProyectoGradosSede[] $proyecto_grados_sedes
 *
 * @package App\Models
 */
class BibliotecasSede extends Model
{
	protected $table = 'bibliotecas_sedes';
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

	public function proyecto_grados_sedes()
	{
		return $this->hasMany(ProyectoGradosSede::class, 'proy_bibl');
	}
}
