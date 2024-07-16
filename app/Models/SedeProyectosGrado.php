<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
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
 * @property int|null $comite
 * @property int|null $docente
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Sede $sede
 * @property SedeBiblioteca $sede_biblioteca
 * @property ComitesSede|null $comites_sede
 * @property UsuariosUser|null $usuarios_user
 * @property Collection|FaseSustentacione[] $fase_sustentaciones
 * @property Collection|FasePropuesta[] $fase_propuestas
 * @property Collection|FaseAnteproyecto[] $fase_anteproyectos
 * @property Collection|FaseProyectosfinale[] $fase_proyectosfinales
 * @property Collection|Integrante[] $integrantes
 *
 * @package App\Models
 */
class SedeProyectosGrado extends Model
{
	protected $table = 'sede_proyectos_grado';
	protected $primaryKey = 'idProyecto';

	protected $casts = [
		'estado' => 'bool',
		'proy_sede' => 'int',
		'proy_bibl' => 'int',
		'comite' => 'int',
		'docente' => 'int'
	];

	protected $fillable = [
		'estado',
		'codigoproyecto',
		'proy_sede',
		'proy_bibl',
		'comite',
		'docente'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'proy_sede');
	}

	public function sede_biblioteca()
	{
		return $this->belongsTo(SedeBiblioteca::class, 'proy_bibl');
	}

	public function comites_sede()
	{
		return $this->belongsTo(ComitesSede::class, 'comite');
	}

	public function usuarios_user()
	{
		return $this->belongsTo(UsuariosUser::class, 'docente');
	}

	public function fase_sustentaciones()
	{
		return $this->hasMany(FaseSustentacione::class, 'sust_proy');
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

	public function integrantes()
	{
		return $this->hasMany(Integrante::class, 'proyecto');
	}
}
