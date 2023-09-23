<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Programa
 * 
 * @property int $idPrograma
 * @property string $programa
 * @property int $prog_facu
 * @property int $prog_sede
 * @property int $prog_usua
 * 
 * @property Facultade $facultade
 * @property Sede $sede
 * @property Usuario $usuario
 *
 * @package App\Models
 */
class Programa extends Model
{
	protected $table = 'programas';
	protected $primaryKey = 'idPrograma';
	public $timestamps = false;

	protected $casts = [
		'prog_facu' => 'int',
		'prog_sede' => 'int',
		'prog_usua' => 'int'
	];

	protected $fillable = [
		'programa',
		'prog_facu',
		'prog_sede',
		'prog_usua'
	];

	public function facultade()
	{
		return $this->belongsTo(Facultade::class, 'prog_facu');
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'prog_sede');
	}

	public function usuario()
	{
		return $this->belongsTo(Usuario::class, 'prog_usua');
	}
}
