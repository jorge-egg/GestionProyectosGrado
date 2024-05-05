<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ComitesSede
 * 
 * @property int $idComite
 * @property int $comi_pro
 * @property string|null $deleted_at
 * 
 * @property SedePrograma $sede_programa
 * @property Collection|IntegrantesComite[] $integrantes_comites
 * @property Collection|SedeProyectosGrado[] $sede_proyectos_grados
 *
 * @package App\Models
 */
class ComitesSede extends Model
{
	use SoftDeletes;
	protected $table = 'comites_sedes';
	protected $primaryKey = 'idComite';
	public $timestamps = false;

	protected $casts = [
		'comi_pro' => 'int'
	];

	protected $fillable = [
		'comi_pro'
	];

	public function sede_programa()
	{
		return $this->belongsTo(SedePrograma::class, 'comi_pro');
	}

	public function integrantes_comites()
	{
		return $this->hasMany(IntegrantesComite::class, 'comite');
	}

	public function sede_proyectos_grados()
	{
		return $this->hasMany(SedeProyectosGrado::class, 'comite');
	}
}
