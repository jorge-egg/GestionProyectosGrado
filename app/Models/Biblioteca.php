<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Biblioteca
 * 
 * @property int $idBiblioteca
 * @property int $bibl_sede
 * 
 * @property Sede $sede
 * @property Collection|ProyectoGrado[] $proyecto_grados
 *
 * @package App\Models
 */
class Biblioteca extends Model
{
	protected $table = 'bibliotecas';
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

	public function proyecto_grados()
	{
		return $this->hasMany(ProyectoGrado::class, 'proy_bibl');
	}
}
