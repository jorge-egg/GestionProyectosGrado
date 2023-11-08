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
 * @property string $nombre
 * @property int $comi_sede
 * @property string|null $deleted_at
 * 
 * @property Sede $sede
 * @property Collection|IntegrantesComite[] $integrantes_comites
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
		'comi_sede' => 'int'
	];

	protected $fillable = [
		'nombre',
		'comi_sede'
	];

	public function sede()
	{
		return $this->belongsTo(Sede::class, 'comi_sede');
	}

	public function integrantes_comites()
	{
		return $this->hasMany(IntegrantesComite::class, 'comite');
	}
}
