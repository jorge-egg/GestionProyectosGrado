<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ProgramasSede
 * 
 * @property int $idPrograma
 * @property string $programa
 * @property int $prog_facu
 * @property int $prog_sede
 * @property int $prog_usua
 * 
 * @property FacultadesSede $facultades_sede
 * @property Sede $sede
 * @property UsuariosUser $usuarios_user
 *
 * @package App\Models
 */
class ProgramasSede extends Model
{
	protected $table = 'programas_sedes';
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

	public function facultades_sede()
	{
		return $this->belongsTo(FacultadesSede::class, 'prog_facu');
	}

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'prog_sede');
	}

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'prog_usua');
	}
}
